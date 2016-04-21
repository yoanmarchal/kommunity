	<select id="elistcat">
		<?php echo my_list_categories_select(['orderby' => 'slug', 'order' => 'ASC', 'hide_empty' => 0, 'number' => 300]); ?>
	</select>

<div id="board" class="metal linear">



	<nav class="second-filt-nav">
		<ul>
		<li><a id="bouton-cat-event" title="Tri par type" href="#"><span class="picto categories"></span><span class="ib">Tri par type</span></a></li>
		<li><a id="bouton-region" title="Tri par région" href="#"><span class="picto region"></span><span class="ib">Tri par régions</span></a></li>
		</ul>
	</nav>

	<div class="filters clearfix combo-filters" id="options">
					
				<div id="region-selector" class="option-combo region">
					
						<ul class="filter option-set clearfix" data-filter-group="region">
							<li><a href="#filter-region-category-any"  data-filter-value="">Toutes les régions</a></li>
							<li><a href="#filter-region-category-alsace"  data-filter-value=".region-alsace">Alsace</a></li>
							<li><a href="#filter-region-category-aquitaine"  data-filter-value=".region-aquitaine">Aquitaine</a></li>
							<li><a href="#filter-region-category-auvergne"  data-filter-value=".region-auvergne">Auvergne</a></li>
							<li><a href="#filter-region-category-bourgogne"  data-filter-value=".region-bourgogne">Bourgogne</a></li>
							<li><a href="#filter-region-category-bretagne"  data-filter-value=".region-bretagne">Bretagne</a></li>
							<li><a href="#filter-region-category-centre"  data-filter-value=".region-centre">Centre</a></li>
							<li><a href="#filter-region-category-champagne-ardenne"  data-filter-value=".region-champagne-ardenne">Champagne-Ardenne</a></li>
							<li><a href="#filter-region-category-corse"  data-filter-value=".region-corse">Corse</a></li>
							<li><a href="#filter-region-category-franche-comte"  data-filter-value=".region-franche-comte">Franche-Comté</a></li>
							<li><a href="#filter-region-category-guadeloupe"  data-filter-value=".region-guadeloupe">Guadeloupe</a></li>
							<li><a href="#filter-region-category-guyane"  data-filter-value=".region-guyane">Guyane</a></li>
							<li><a href="#filter-region-category-ile-de-france"  data-filter-value=".region-ile-de-france">Île-de-France</a></li>
							<li><a href="#filter-region-category-languedoc-roussillon"  data-filter-value=".region-languedoc-roussillon">Languedoc-Roussillon</a></li>
							<li><a href="#filter-region-category-limousin"  data-filter-value=".region-limousin">Limousin</a></li>
							<li><a href="#filter-region-category-lorraine"  data-filter-value=".region-lorraine">Lorraine</a></li>
							<li><a href="#filter-region-category-martinique"  data-filter-value=".region-martinique">Martinique</a></li>
							<li><a href="#filter-region-category-mayotte"  data-filter-value=".region-mayotte">Mayotte</a></li>
							<li><a href="#filter-region-category-midi-pyrenees"  data-filter-value=".region-midi-pyrenees">Midi Pyrénées</a></li>
							<li><a href="#filter-region-category-nord-pas-de-calais"  data-filter-value=".region-nord-pas-de-calais">Nord-Pas-de-Calais</a></li>
							<li><a href="#filter-region-category-basse-normandie"  data-filter-value=".region-basse-normandie">Basse-Normandie</a></li>
							<li><a href="#filter-region-category-haute-normandie"  data-filter-value=".region-haute-normandie">Haute-Normandie</a></li>
							<li><a href="#filter-region-category-pays-de-la-loire"  data-filter-value=".region-pays-de-la-loire">Pays de la Loire</a></li>
							<li><a href="#filter-region-category-picardie"  data-filter-value=".region-picardie">Picardie</a></li>
							<li><a href="#filter-region-category-poitou-charente"  data-filter-value=".region-poitou-charentes">Poitou-Charentes</a></li>
							<li><a href="#filter-region-category-provence-alpes-cote-d-azur"  data-filter-value=".region-provence-alpes-cote-d-azur">Provence-Alpes-Côte d'Azur</a></li>
							<li><a href="#filter-region-category-la-reunion"  data-filter-value=".region-la-reunion">La Réunion</a></li>
							<li><a href="#filter-region-category-rhone-alpes"  data-filter-value=".region-rhone-alpes">Rhône-Alpes</a></li>
						</ul>
				</div>
				<div id="cat-event-selector" class="option-combo type">
						<ul class="filter option-set clearfix" data-filter-group="type">
							<li><a href="#filter-type-category-any"  data-filter-value="">Tout les évènements</a></li>
							<li><a href="#filter-type-category-ballets"  data-filter-value=".category-ballets">Ballets</a></li>
							<li><a href="#filter-type-category-bal"  data-filter-value=".category-bal">Bals</a></li>
							<li><a href="#filter-type-category-cabarets"  data-filter-value=".category-cabarets">Cabarets</a></li>
							<li><a href="#filter-type-category-cinema"  data-filter-value=".category-cinema">Cinémas</a></li>
							<li><a href="#filter-type-category-cirques"  data-filter-value=".category-cirques">Cirques</a></li>
							<li><a href="#filter-type-category-comedie-musicale"  data-filter-value=".category-comedie-musicale">Comédies musicales</a></li>
							<li><a href="#filter-type-category-concert"  data-filter-value=".category-concert">Concerts</a></li>
							<li><a href="#filter-type-category-conference"  data-filter-value=".category-conference">Conférences</a></li>
							<li><a href="#filter-type-category-danse"  data-filter-value=".category-danse">Danses</a></li>
							<li><a href="#filter-type-category-dedicaces"  data-filter-value=".category-dedicaces">Dédicaces</a></li>
							<li><a href="#filter-type-category-expositions"  data-filter-value=".category-expositions">Expositions</a></li>
							<li><a href="#filter-type-category-festival"  data-filter-value=".category-festival">Festivals</a></li>
							<li><a href="#filter-type-category-foires"  data-filter-value=".category-foires">Foires</a></li>
							<li><a href="#filter-type-category-forum"  data-filter-value=".category-forum">Forums</a></li>
							<li><a href="#filter-type-category-inauguration"  data-filter-value=".category-inauguration">Inaugurations</a></li>
							<li><a href="#filter-type-category-journees-du-patrimoine"  data-filter-value=".category-journees-du-patrimoine">Journées du patrimoine</a></li>
							<li><a href="#filter-type-category-promotions"  data-filter-value=".category-promotions">Promotions</a></li>
							<li><a href="#filter-type-category-salon"  data-filter-value=".category-salon">Salons</a></li>
							<li><a href="#filter-type-category-show-case"  data-filter-value=".category-show-case">Show-case</a></li>
							<li><a href="#filter-type-category-soirees"  data-filter-value=".category-soirees">Soirées</a></li>
							<li><a href="#filter-type-category-spectacles"  data-filter-value=".category-spectacles">Spectacles</a></li>
							<li><a href="#filter-type-category-sports"  data-filter-value=".category-sports">Sports</a></li>
							<li><a href="#filter-type-category-theatre"  data-filter-value=".category-theatre">Théatres</a></li>
							<li><a href="#filter-type-category-vernissage"  data-filter-value=".category-vernissage">Vernissages</a></li>
							<li><a href="#filter-type-category-videgrenier"  data-filter-value=".category-videgrenier">Vides greniers</a></li>
							<li><a href="#filter-type-category-non-classe	"  data-filter-value=".category-non-classe">Non classé</a></li>
						</ul>
				</div>
	</div>
</div>