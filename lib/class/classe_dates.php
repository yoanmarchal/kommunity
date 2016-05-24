<?php
/**
 * Classe de traitement des dates
 * regoupe les fonctions communes d'exploitation des dates
 * - convertion de dates en diff�rents formats
 * - r�cup�ration des infos d'une date (ann�e, mois, jour, heure)
 * - r�cup�ration d'une date � n jours d'intervalle.
 *
 * PHP versions 5
 *
 * @author		romualb <contact@romualb.com>
 * @copyright	2008-2010 romualb
 *
 * @version 	1.7.0
 * @date 		21/04/2010
*/
    class classe_date
    {
        /*_______________________________________________________________________________________________________________
                                                                                MEMBRES
*/

        protected $jours = [
            'FR' => [0 => 'Dimanche', 1 => 'Lundi', 2 => 'Mardi', 3 => 'Mercredi', 4 => 'Jeudi', 5 => 'Vendredi', 6 => 'Samedi', 7 => 'Dimanche'],
            'EN' => [0 => 'Sunday', 1 => 'Monday', 2 => 'Tuesday', 3 => 'Wednesday', 4 => 'Thursday', 5 => 'Friday', 6 => 'Saturday', 7 => 'Sunday'],
            ];
        protected $joursC = [
            'FR' => [0 => 'Dim.', 1 => 'Lun.', 2 => 'Mar.', 3 => 'Mer.', 4 => 'Jeu.', 5 => 'Ven.', 6 => 'Sam.', 7 => 'Dim.'],
            'EN' => [0 => 'Sun.', 1 => 'Mon.', 2 => 'Tue.', 3 => 'Wed.', 4 => 'Thu.', 5 => 'Fri.', 6 => 'Sat.', 7 => 'Sun.'],
            ];
        protected $mois = [
            'FR' => [1 => 'Janvier', 2 => 'F�vrier', 3 => 'Mars', 4 => 'Avril', 5 => 'Mai', 6 => 'Juin', 7 => 'Juillet', 8 => 'Ao�t', 9 => 'Septembre', 10 => 'Octobre', 11 => 'Novembre', 12 => 'D�cembre'],
            'EN' => [1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'],
            ];
        protected $moisC = [
            'FR' => [1 => 'Janv.', 2 => 'F�vr.', 3 => 'Mars', 4 => 'Avr.', 5 => 'Mai', 6 => 'Juin', 7 => 'Juil.', 8 => 'Ao�t', 9 => 'Sept.', 10 => 'Oct.', 11 => 'Nov.', 12 => 'D�c.'],
            'EN' => [1 => 'Jan.', 2 => 'Feb.', 3 => 'Mar.', 4 => 'Apr.', 5 => 'May', 6 => 'Jun.', 7 => 'Jul.', 8 => 'Aug.', 9 => 'Sep.', 10 => 'Oct.', 11 => 'Nov.', 12 => 'Dec.'],
            ];

        protected $lng = 'FR';

        public $date = '';
        public $jourCourt = false;
        public $moisCourt = false;
        public $heure = false;
        public $heureCourte = false;

/*_______________________________________________________________________________________________________________
                                                                                METHODES PRIVEES
*/

        /**
         * retourne le no du jour de la semaine
         * la semaine commence le lundi (1) et se termine le dimanche (7).
         */
        protected function _getNoJourSemaine($a_jour)
        {
            $jour = strtolower($a_jour);
            switch ($jour) {
                case 'lundi':        case 'lun':
                case 'monday':        case 'mon':
                    $num = 1; break;
                case 'mardi':        case 'mar':
                case 'tuesday':        case 'tue':
                    $num = 2; break;
                case 'mercredi':    case 'mer':
                case 'wednesday':    case 'wed':
                    $num = 3; break;
                case 'jeudi':        case 'jeu':
                case 'thursday':    case 'thu':
                    $num = 4; break;
                case 'vendredi':    case 'ven':
                case 'friday':        case 'fri':
                    $num = 5; break;
                case 'samedi':        case 'sam':
                case 'saturday':    case 'sat':
                    $num = 6; break;
                case 'dimanche':    case 'dim':
                case 'sunday':        case 'sun':
                    $num = 7; break;
            }

            return $num;
        }

        /**
         * retourne le nom du mois correspondant � un no de mois.
         */
        protected function _num2Month($a_mois)
        {
            $res = $this->moisCourt ? $this->moisC[$this->lng][$a_mois] : $this->mois[$this->lng][$a_mois];

            return htmlentities($res);
        }

        /**
         * retourne le no du mois
         * fran�ais et anglais.
         */
        protected function _month2Num($a_mois)
        {
            $num = '';
            switch (strtolower($a_mois)) {
                case 'janvier':            case 'jan':
                case 'january':
                    $num = '01'; break;

                case 'fevrier':            case 'f�vrier':            case 'fev':            case 'f�v':
                case 'february':        case 'feb':
                    $num = '02'; break;

                case 'mars':            case 'mar':
                case 'march':
                    $num = '03'; break;

                case 'avril':            case 'avr':
                case 'april':            case 'apr':
                    $num = '04'; break;

                case 'mai':
                case 'may':
                    $num = '05'; break;

                case 'juin':            case 'jun':
                case 'june':
                    $num = '06'; break;

                case 'juillet':            case 'jul':
                case 'july':
                    $num = '07'; break;

                case 'aout':            case 'ao�t':            case 'aou':            case 'ao�':
                case 'august':            case 'aug':
                    $num = '08'; break;

                case 'septembre':        case 'sep':
                case 'septeber':
                    $num = '09'; break;

                case 'octobre':            case 'oct':
                case 'october':
                    $num = '10'; break;

                case 'novembre':        case 'nov':
                case 'november':
                    $num = '11'; break;

                case 'decembre':        case 'd�cembre':        case 'dec':            case 'd�c':
                case 'december':
                    $num = '12'; break;
            }

            return $num;
        }

        /**
         * analyse une date et retourne un tableau de la forme:
         * array['format']
         * array['ann�e']
         * array['mois']
         * array['jour']
         * array['heure']
         * si la date n'est pas pr�cis�e, on prend en compte le membre $date.
         */
        public function _getInfosDate($a_date = '')
        {
            $patternFr = '/^(lundi|lun|mardi|mar|mercredi|mer|jeudi|jeu|vendredi|ven|samedi|sam|dimanche|dim)?';
            $patternFr .= "[[:space:]]*([\d]{1,2})";
            $patternFr .= '[[:space:]]*(janvier|jan|fevrier|f�vrier|fev|f�v|mars|mar|avril|avr|mai|juin|jui|juillet|aout|ao�t|aou|ao�|septembre|sep|octobre|oct|novembre|nov|decembre|d�cembre|dec|d�c)';
            $patternFr .= "[[:space:]]*([\d]{2,4})";
            $patternFr .= "[[:space:]]?([\d]{2}:[\d]{2}(:[\d]{2})*)?";
            $patternFr .= '$/i';

            $patternEn = '/^(monday|mon|tuesday|tue|wednesday|wed|thursday|thu|friday|fri|saturday|sat|sunday|sun)?';
            $patternEn .= "[[:space:]]*([\d]{1,2}(st|nd|rd|th))";
            $patternEn .= '[[:space:]]*(january|jan|february|feb|march|mar|april|apr|may|june|july|august|aug|september|sep|october|oct|november|nov|december|dec)';
            $patternEn .= "[[:space:]]*([\d]{2,4})";
            $patternEn .= "[[:space:]]?([\d]{2}:[\d]{2}(:[\d]{2})*)?";
            $patternEn .= '$/i';

            $res = [];
            $date = strlen($a_date) > 0 ? $a_date : $this->date;

            // timestamp
            if (is_numeric($date)) {
                $res['format'] = 'UNX';
                $res['annee'] = date('Y', $date);
                $res['mois'] = date('m', $date);
                $res['jour'] = date('j', $date);
                $res['heure'] = date('H:i:s', $date);
            }
            // SQL 					2008-08-11 15:30:21
            elseif (preg_match("/^([\d]{4})-([\d]{2})-([\d]{2})( [\d]{2}:[\d]{2}:[\d]{2})?$/", $date, $l_date)) {
                $res['format'] = 'SQL';
                $res['annee'] = $l_date[1];
                $res['mois'] = $l_date[2];
                $res['jour'] = $l_date[3];
                $res['heure'] = isset($l_date[4]) ? trim($l_date[4]) : '00:00:00';
            }
            // STR 					11/08/2008 ou 11/08/2008
            elseif (preg_match("/^([\d]{1,2})\/([\d]{1,2})\/([\d]{2,4})([[:space:]]?[\d]{2}:[\d]{2}(:[\d]{2})*)?$/", $date, $l_date)) {
                $res['format'] = 'STR';
                $res['annee'] = $l_date[3];
                $res['mois'] = $l_date[2];
                $res['jour'] = $l_date[1];
                $res['heure'] = isset($l_date[4]) ? trim($l_date[4]) : '00:00:00';
            }
            // RSS					Mon, 11 Aug 2008 14:18:58
            elseif (preg_match("/^([\w]{3}), ([\d]{1,2}) ([\w]{1,3}) ([\d]{2,4}) ([\d]{2}:[\d]{2}:[\d]{2})$/i", $date, $l_date)) {
                $res['format'] = 'RSS';
                $res['annee'] = $l_date[4];
                $res['mois'] = $this->_month2Num($l_date[3]);
                $res['jour'] = $l_date[2];
                $res['heure'] = isset($l_date[5]) ? trim($l_date[5]) : '00:00:00';
            }

            // FR 					lundi 11 aout 2008 14:18:58
            elseif (preg_match($patternFr, $date, $l_date)) {
                $res['format'] = 'FR';
                $res['annee'] = $l_date[4];
                $res['mois'] = $this->_month2Num($l_date[3]);
                $res['jour'] = $l_date[2];
                $res['heure'] = isset($l_date[5]) ? trim($l_date[5]) : '00:00:00';
            }

            // EN 					Monday 11th august 2008 14:18:58
            elseif (preg_match($patternEn, $date, $l_date)) {
                $res['format'] = 'EN';
                $res['annee'] = $l_date[4];
                $res['mois'] = $this->_month2Num($l_date[3]);
                $res['jour'] = $l_date[2];
                $res['heure'] = isset($l_date[5]) ? trim($l_date[5]) : '00:00:00';
            }

            return $res;
        }

/*_______________________________________________________________________________________________________________
                                                                                METHODES PUBLIQUES
*/

        /**
         * constructeur
         * a_date = date.
         */
        public function __construct($a_date = '', $a_format = '')
        {
            setlocale(LC_TIME, 'fr_FR', 'fra');
            $this->jourCourt = false;
            $this->moisCourt = false;
            $this->heure = false;
            if (strlen($a_date) > 0) {
                $this->setDate($a_date, $a_format);
            }
        }

        /**
         * d�finit la langue du calendrier
         * FR, EN.
         */
        public function setLangue($a_langue)
        {
            $this->lng = $a_langue;
        }

        /**
         * d�finit / change la date en cours.
         */
        public function setDate($a_date, $a_format = '')
        {
            $infos = $this->_getInfosDate($a_date);
            if ($infos['heure'] != '00:00:00') {
                $this->setHeure();
            }
            $this->date = $this->convert($a_format, $a_date);
        }

        /**
         * retourne la date en cours.
         */
        public function getDate($a_format = '')
        {
            $date = $this->convert($a_format);

            return $date;
        }

        /**
         * retourne l'ann�e d'une date
         * si la date n'est pas pr�cis�e, on prend en compte le membre $date.
         */
        public function getAnnee($a_date = '')
        {
            $date = strlen($a_date) > 0 ? $a_date : $this->date;
            $infos = $this->_getInfosDate($date);
            if (isset($infos['annee'])) {
                return $infos['annee'];
            }
        }

        /**
         * retourne le no de mois d'une date
         * si la date n'est pas pr�cis�e, on prend en compte le membre $date.
         */
        public function getMois($a_date = '')
        {
            $date = strlen($a_date) > 0 ? $a_date : $this->date;
            $date = $this->convert('UNX', $date);

            return date('m', $date);
        }

        /**
         * retourne le nom du mois d'une date
         * si la date n'est pas pr�cis�e, on prend en compte le membre $date.
         */
        public function getNomMois($a_date = '')
        {
            $noMois = intval($this->getMois($a_date));

            return $this->moisCourt ? $this->moisC[$this->lng][$noMois] : $this->mois[$this->lng][$noMois];
        }

        /**
         * retourne le no de semaine d'une date
         * si la date n'est pas pr�cis�e, on prend en compte le membre $date.
         */
        public function getSemaine($a_date = '')
        {
            $date = strlen($a_date) > 0 ? $a_date : $this->date;
            $date = $this->convert('UNX', $date);

            return date('W', $date);
        }

        /**
         * retourne le jour d'une date
         * si la date n'est pas pr�cis�e, on prend en compte le membre $date.
         */
        public function getJour($a_date = '')
        {
            $date = strlen($a_date) > 0 ? $a_date : $this->date;
            $infos = $this->_getInfosDate($date);

            return $infos['jour'];
        }

        /**

         * retourne le nom du jour d'une date
         * si la date n'est pas pr�cis�e, on prend en compte le membre $date.
         */
        public function getNomJour($a_date = '')
        {
            $date = strlen($a_date) > 0 ? $a_date : $this->date;
            $date = $this->convert('UNX', $date);

            return $this->jourCourt ? $this->joursC[$this->lng][gmdate('w', $date)] : $this->jours[$this->lng][gmdate('w', $date)];
        }

        /**
         * retourne le format d'une date
         * si la date n'est pas pr�cis�e, on prend en compte le membre $date.
         */
        public function getFormat($a_date = '')
        {
            $date = strlen($a_date) ? $a_date : $this->date;
            $infos = $this->_getInfosDate($date);

            return $infos['format'];
        }

        /**
         * v�rifie si une ann�e est bisextile
         * si l'annee $a_annee est pr�cis�e, on test sur cette ann�e
         * sinon on teste sur le membre $date.
         */
        public function isBisextile($a_annee = '')
        {
            $date = strlen($a_annee) ? gmmktime(1, 0, 0, 1, 1, $a_annee) : $this->convert('UNX', $this->date);

            return date('L', $date);
        }

        /**
         * nombre de jours dans le mois
         * si le mois et l'annee sont pr�cis�s, on prend en compte ces valeurs
         * si l'ann�e n'est pas pr�cis�e, on prend en compte l'ann�e du membre $date
         * sinon on teste sur le membre $date
         * $a_mois : no du mois ou mois litt�ral
         * $a_annee : ann�e YYYY.
         */
        public function getJoursMois($a_mois = '', $a_annee = '')
        {
            // on enleve le d�calage horaire
            if (strlen($a_mois) > 0) {
                $mois = ($a_mois >= 1 && $a_mois <= 12) ? $a_mois : $this->_month2Num($a_mois);
            }
            $date = strlen($a_mois) > 0 ? gmmktime(12, 0, 0, intval($mois), 1, (strlen($a_annee) > 0 ? $a_annee : $this->getAnnee())) : $this->convert('UNX', $this->date);

            return date('t', $date);
        }

        /**
         * retourne la date d'un jour (lundi, mardi...) de la semaine
         * $a_semaine = no de semaine
         * $a_annee = ann�e, par d�faut celle du membre $date
         * $a_jour = jour recherch� (par d�faut, lundi)
         * $a_format unix par d�faut.
         */
        public function getJourSemaine($a_semaine, $a_jour = 'lundi', $a_format = 'UNX', $a_annee = '')
        {
            if (strlen($a_annee) == 0) {
                $a_annee = $this->getAnnee();
            }
            if (strftime('%W', gmmktime(0, 0, 0, 01, 01, $a_annee)) == 1) {
                $mon_mktime = gmmktime(0, 0, 0, 01, (01 + (($a_semaine - 1) * 7)), $a_annee);
            } else {
                $mon_mktime = gmmktime(0, 0, 0, 01, (01 + (($a_semaine) * 7)), $a_annee);
            }

            // le 04 janvier est toujours en premi�re semaine
            // on cherche le jour du 04 janvier pour calculer le d�calage
            $decalage = (date('w', $mon_mktime) - 1) * 60 * 60 * 24;
            $quatreJan = date('w', gmmktime(1, 0, 0, 1, 4, $a_annee));

            // si le 04 janvier tombe du jeudi au dimanche
            if ($quatreJan == 0 || $quatreJan >= 4) {
                // si le 1er janvier tombe un lundi
                if (date('w', gmmktime(1, 0, 0, 1, 1, $a_annee)) == 1) {
                    $decalage = $decalage;
                } else {
                    $decalage = $decalage + (7 * 60 * 60 * 24);
                }
            }
            // sinon si le 1er janvier tombe un dimanche
            elseif (date('w', gmmktime(1, 0, 0, 1, 1, $a_annee)) == 0) {
                $decalage = $decalage + (7 * 60 * 60 * 24);
            }
            $noJour = $this->_getNoJourSemaine($a_jour) - 1;
            $jour = $mon_mktime - $decalage + ($noJour * 60 * 60 * 24);
            $date = $this->convert($a_format, $jour);

            return $date;
        }

        /**
         * nombre de jours entre deux dates.
         */
        public function getJoursPeriode($a_dateFrom, $a_dateTo)
        {
            $a_dateFrom = $this->convert('UNX', $a_dateFrom);
            $a_dateTo = $this->convert('UNX', $a_dateTo);

            return  (($a_dateTo - $a_dateFrom) / 60 / 60 / 24) + 1;
        }

        /**
         * convertion d'une date
         * $a_format : format voulu (par d�faut, le m�me que la date)
         * $a_date : la date � convertir si diff�rente de $date
         * SQL		:	YYYY-MM-JJ H:i:s
         * STR		:	JJ/MM/YYYY H:i:s
         * FR		:	Jour JJ Mois YYYY
         * EN		:	Jour JJth Mois YYYY
         * UNX		:	timestamp unix
         * URL		:	YYYY/MM/JJ
         * USR		:	MM/JJ/YYYY (pour commande linux useradd)
         * RSS		:	Mon, 11 Aug 2008 14:18:58 (RFC822).
         */
        public function convert($a_format = '', $a_date = '')
        {
            $res = false;
            // analyse de la date saisie
            $l_date = $this->_getInfosDate(strlen($a_date) > 0 ? $a_date : $this->date);
            if (strlen($a_format) == 0) {
                $a_format = $l_date['format'];
            }
            if (isset($l_date['format'])) {
                $heures = explode(':', $l_date['heure']);
                if ($this->heure) {
                    $timestamp = gmmktime($heures[0], $heures[1], (isset($heures[2]) ? $heures[2] : 0), $l_date['mois'], $l_date['jour'], $l_date['annee']);
                } else {
                    $timestamp = gmmktime(0, 0, 0, $l_date['mois'], $l_date['jour'], $l_date['annee']);
                }
                switch ($a_format) {
                    case 'SQL':
                        $res = gmdate('Y-m-d'.($this->heure ? ' H:i:s' : ''), $timestamp);
                        break;
                    case 'STR':
                        $res = gmdate('d/m/Y'.($this->heure ? ' H:i'.(!$this->heureCourte ? ':s' : '') : ''), $timestamp);
                        break;
                    case 'FR':
                        $res = ($this->jourCourt ? $this->joursC['FR'][gmdate('w', $timestamp)] : $this->jours['FR'][gmdate('w', $timestamp)]).
                                gmdate(' d ', $timestamp).
                                ($this->moisCourt ? $this->moisC['FR'][gmdate('n', $timestamp)] : $this->mois['FR'][gmdate('n', $timestamp)]).
                                gmdate(' Y'.($this->heure ? ' H:i'.(!$this->heureCourte ? ':s' : '') : ''), $timestamp);
                        break;
                    case 'EN':
                        $day = gmdate(' d', $timestamp);
                        if (preg_match('/1$/', $day)) {
                            $jour = $day.'st ';
                        } elseif (preg_match('/2$/', $day)) {
                            $jour = $day.'nd ';
                        } elseif (preg_match('/3$/', $day)) {
                            $jour = $day.'rd ';
                        } else {
                            $jour = $day.'th ';
                        }
                        $res = ($this->jourCourt ? $this->joursC['EN'][gmdate('w', $timestamp)] : $this->jours['EN'][gmdate('w', $timestamp)]).
                                 $jour.
                                ($this->moisCourt ? $this->moisC['EN'][gmdate('n', $timestamp)] : $this->mois['EN'][gmdate('n', $timestamp)]).
                                gmdate(' Y'.($this->heure ? ' H:i'.(!$this->heureCourte ? ':s' : '') : ''), $timestamp);
                        break;
                    case 'UNX':
                        $res = $timestamp;
                        break;
                    case 'URL':
                        $res = gmdate('Y/m/d', $timestamp);
                        break;
                    case 'USR':
                        $res = gmdate('m/d/Y', $timestamp);
                        break;
                    case 'RSS':
                        $res = gmdate('D, d M Y H:i:s', $timestamp);
                        break;
                }
            }

            return $res;
        }

        /**
         * prise en compte du format de jour court.
         */
        public function setJourCourt($a_bool = true)
        {
            $this->jourCourt = $a_bool;
        }

        /**
         * prise en compte du format de jour court.
         */
        public function setMoisCourt($a_bool = true)
        {
            $this->moisCourt = $a_bool;
        }

        /**
         * prise en compte de l'heure.
         */
        public function setHeure($a_bool = true)
        {
            $this->heure = $a_bool;
        }

        /**
         * affichage de l'heure sans les secondes.
         */
        public function setHeureCourte($a_bool = true)
        {
            $this->heure = true;
            $this->heureCourte = $a_bool;
        }

        /**
         * retourne la date a n jours d'ecart
         * $a_nbJours = nb de jours d'�cart
         * $a_format = format de retour (le m�me que $this->date si pas pr�cis�.
         */
        public function getDateFrom($a_nbJours, $a_format = '', $a_date = '')
        {
            $l_date = strlen($a_date) > 0 ? $a_date : $this->date;
            // format de date
            if (strlen($a_format) == 0) {
                $format = $this->_getInfosDate($l_date);
                $a_format = $format['format'];
            }
            //
            $unxDate = $this->convert('UNX', $l_date);
            $unxNewDate = $unxDate + $a_nbJours * 24 * 60 * 60;

            return $this->convert($a_format, $unxNewDate);
        }
    }
