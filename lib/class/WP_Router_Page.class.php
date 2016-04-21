<?php

class WP_Router_Page extends WP_Router_Utility
{
    const POST_TYPE = 'wp_router_page';

    protected static $rewrite_slug = 'WP_Router';
    protected static $post_id = 0; // The ID of the post this plugin uses

    protected $contents = '';
    protected $title = '';
    protected $template = '';
    protected $meta = [];

    public static function init()
    {
        self::register_post_type();
    }

    /**
     * Register a post type to use when displaying pages.
     *
     * @static
     *
     * @return void
     */
    private static function register_post_type()
    {
        // a very quiet post type
        $args = [
            'public'              => false,
            'show_ui'             => false,
            'exclude_from_search' => true,
            'publicly_queryable'  => true,
            'show_in_menu'        => false,
            'show_in_nav_menus'   => false,
            'supports'            => ['title'],
            'has_archive'         => true,
            'rewrite'             => [
                'slug'       => self::$rewrite_slug,
                'with_front' => false,
                'feeds'      => false,
                'pages'      => false,
            ],
        ];
        register_post_type(self::POST_TYPE, $args);
    }

    /**
     * Get the ID of the placeholder post.
     *
     * @static
     *
     * @return int
     */
    protected static function get_post_id()
    {
        if (!self::$post_id) {
            $posts = get_posts([
                'post_type'      => self::POST_TYPE,
                'post_status'    => 'publish',
                'posts_per_page' => 1,
            ]);
            if ($posts) {
                self::$post_id = $posts[0]->ID;
            } else {
                self::$post_id = self::make_post();
            }
        }

        return self::$post_id;
    }

    /**
     * Make a new placeholder post.
     *
     * @static
     *
     * @return int The ID of the new post
     */
    private static function make_post()
    {
        $post = [
            'post_title'  => __('WP Router Placeholder Page', 'wp-router'),
            'post_status' => 'publish',
            'post_type'   => self::POST_TYPE,
        ];
        $id = wp_insert_post($post);
        if (is_wp_error($id)) {
            return 0;
        }

        return $id;
    }

    public function __construct($contents, $title, $template = '')
    {
        $this->contents = $contents;
        $this->title = $title;
        $this->template = $template;
        $this->add_hooks();
    }

    protected function add_hooks()
    {
        add_action('pre_get_posts', [$this, 'edit_query'], 10, 1);
        add_action('the_post', [$this, 'set_post_contents'], 10, 1);
        add_filter('the_title', [$this, 'get_title'], 10, 2);
        add_filter('single_post_title', [$this, 'get_single_post_title'], 10, 2);
        add_filter('redirect_canonical', [$this, 'override_redirect'], 10, 2);
        add_filter('get_post_metadata', [$this, 'set_post_meta'], 10, 4);
        add_filter('post_type_link', [$this, 'override_permalink'], 10, 4);
        if ($this->template) {
            add_filter('template_include', [$this, 'override_template'], 10, 1);
        }
    }

    /**
     * Edit WordPress's query so it finds our placeholder page.
     *
     * @param WP_Query $query
     *
     * @return void
     */
    public function edit_query(WP_Query $query)
    {
        if (isset($query->query_vars[self::QUERY_VAR])) {
            // make sure we get the right post
            $query->query_vars['post_type'] = self::POST_TYPE;
            $query->query_vars['p'] = self::get_post_id();

            // override any vars WordPress set based on the original query
            $query->is_single = true;
            $query->is_singular = true;
            $query->is_404 = false;
            $query->is_home = false;
        }
    }

    /**
     * Override the global $pages array to yield our content.
     *
     * @param object $post
     *
     * @return void
     */
    public function set_post_contents($post)
    {
        global $pages;
        $pages = [$this->contents];
        // TODO: add a facility for multi-page documents?
    }

    /**
     * Set the title for the placeholder page.
     *
     * @param string $title
     * @param int    $post_id
     *
     * @return string
     */
    public function get_title($title, $post_id)
    {
        if ($post_id == self::get_post_id()) {
            $title = $this->title;
        }

        return $title;
    }

    /**
     * Set the title for the placeholder page (again).
     *
     * @param string $title
     * @param object $post
     *
     * @return string
     */
    public function get_single_post_title($title, $post = null)
    {
        // in WP 3.0.x, $post might be NULL. Not true in WP 3.1
        if (!$post) {
            $post = $GLOBALS['post'];
        }

        return $this->get_title($title, $post->ID);
    }

    /**
     * Use the specified template file.
     *
     * @param string $template
     *
     * @return string
     */
    public function override_template($template)
    {
        if ($this->template && file_exists($template)) { // these checks shouldn't be necessary, but no harm
            return $this->template;
        }

        return $template;
    }

    /**
     * If asking for a paged router page, or if %category% is in
     * the permastruct, WordPress will try to redirect to the URL
     * for the dummy page. This should stop that from happening.
     *
     * @wordpress-filter redirect_canonical
     *
     * @param string $redirect_url
     * @param string $requested_url
     *
     * @return bool
     */
    public function override_redirect($redirect_url, $requested_url)
    {
        if ($redirect_url && get_query_var('WP_Route')) {
            return false;
        }
        if ($redirect_url && get_permalink(self::get_post_id()) == $redirect_url) {
            return false;
        }

        return $redirect_url;
    }

    /**
     * Some plugins expect certain data in post meta. It obviously
     * won't be there for the placeholder page. Let's pretend
     * it is there.
     *
     * @param array|null $meta
     * @param int        $post_id
     * @param string     $meta_key
     * @param bool       $single
     *
     * @return array
     */
    public function set_post_meta($meta, $post_id, $meta_key, $single)
    {
        if ($post_id == self::get_post_id()) {
            if (empty($this->meta)) {
                $this->meta = [
                    '_yoast_wpseo_title' => [$this->get_title('', $post_id)],
                ];
                $this->meta = apply_filters('wp_router_placeholder_postmeta', $this->meta);
            }
            if ($meta_key) {
                if (empty($this->meta[$meta_key])) {
                    return;
                }

                return $this->meta[$meta_key];
            }

            return $this->meta;
        }

        return $meta;
    }

    public function override_permalink($post_link, $post, $leavename, $sample)
    {
        if ($post->ID == self::get_post_id()) {
            if ($post->ID == get_queried_object_id()) {
                global $wp;

                return home_url($wp->request);
            }
        }

        return $post_link;
    }
}
