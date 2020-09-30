<?php

/*
 *  Find and replace abbreviations in street names
 */
$abbrev = array(
            // Prefixes
            '/^N (.*)/i',
            '/^S (.*)/i',
            '/^E (.*)/i',
            '/^W (.*)/i',

            '/^Ave (.*)/i',
            '/^Avnda (.*)/i',
            '/^Cam (.*)/i',
            '/^Camta (.*)/i',
            '/^Camto (.*)/i',
            '/^Cte (.*)/i',
            '/^Mt (.*)/i',
            '/^Mtn (.*)/i',
            '/^St (.*)/i',

            // In the middle of the name
            '/^(.*) De (.*)$/',
            '/^(.*) Del (.*)$/',
            '/^(.*) Du (.*)$/',
            '/^(.*) El (.*)$/',
            '/^(.*) Hwy (.*)$/',
            '/^(.*) La (.*)$/',
            '/^(.*) Mtn (.*)$/',
            '/^(.*) Of (.*)$/',
            '/^(.*) St (.*)$/',

            // Suffixes
            '/(.*) Av$/i',
            '/(.*) Ave$/i',
            '/(.*) Bch$/i',
            '/(.*) Bl$/i',
            '/(.*) Blvd$/i',
            '/(.*) Bnd$/i',
            '/(.*) Ci$/i',
            '/(.*) Cir$/i',
            '/(.*) Cr$/i',
            '/(.*) Crst$/i',
            '/(.*) Ct$/i',
            '/(.*) Cv$/i',
            '/(.*) Cy$/i',
            '/(.*) Cyn$/i',
            '/(.*) Dr$/i',
            '/(.*) Gl$/i',
            '/(.*) Gln$/i',
            '/(.*) Gr$/i',
            '/(.*) Hvn$/i',
            '/(.*) Hw$/i',
            '/(.*) Hwy$/i',
            '/(.*) Hts$/i',
            '/(.*) Hy$/i',
            '/(.*) Knl$/i',
            '/(.*) La$/i',
            '/(.*) Ln$/i',
            '/(.*) Lo$/i',
            '/(.*) Lp$/i',
            '/(.*) N$/i',
            '/(.*) Orch$/i',
            '/(.*) Pa$/i',
            '/(.*) Pk$/i',
            '/(.*) Pkwy$/i',
            '/(.*) Pl$/i',
            '/(.*) Prt$/i',
            '/(.*) Pt$/i',
            '/(.*) Py$/i',
            '/(.*) Rd$/i',
            '/(.*) Rdg$/i',
            '/(.*) Ro$/i',
            '/(.*) Rw$/i',
            '/(.*) Sq$/i',
            '/(.*) St$/i',
            '/(.*) St\.$/i',
            '/(.*) Te$/i',
            '/(.*) Ter$/i',
            '/(.*) Tl$/i',
            '/(.*) Tr$/i',
            '/(.*) Trl$/i',
            '/(.*) Tt$/i',
            '/(.*) Vw$/i',
            '/(.*) W$/i',
            '/(.*) Wa$/i',
            '/(.*) Wl$/i',
            '/(.*) Wk$/i',
            '/(.*) Wy$/i',
            '/(.*) Xi$/i',

            // Special cases
            '/(.*) el Camino Real$/i',
            '/^East Avenue$/i',
            '/^East Street$/i',
          );

$expanded = array(
            // Prefixes
            'North ${1}',           // N
            'South ${1}',           // S
            'East ${1}',            // E (be careful of "E Street")
            'West ${1}',            // W

            'Avenida ${1}',         // Ave
            'Avenida ${1}',         // Avnda
            'Camino ${1}',          // Cam
            'Caminita ${1}',        // Camta
            'Caminito ${1}',        // Camto
            'Corte ${1}',           // Cte
            'Mount ${1}',           // Mt
            'Mountain ${1}',        // Mtn
            'Saint ${1}',           // St

            // Word in the middle of the name
            '${1} de ${2}',         // De
            '${1} del ${2}',        // Del
            '${1} du ${2}',         // Du
            '${1} el ${2}',         // El
            '${1} Highway ${2}',    // Hwy
            '${1} la ${2}',         // La
            '${1} Mountain ${2}',   // Mtn
            '${1} of ${2}',         // Of
            '${1} Saint ${2}',      // St

            // Suffixes
            // See: https://pe.usps.com/text/pub28/28apc_002.htm
            '${1} Avenue',          // Av
            '${1} Avenue',          // Ave
            '${1} Beach',           // Bch
            '${1} Boulevard',       // Bl
            '${1} Boulevard',       // Blvd
            '${1} Bend',            // Bnd
            '${1} Circle',          // Ci
            '${1} Circle',          // Cir
            '${1} Circle',          // Cr
            '${1} Crest',           // Crst
            '${1} Court',           // Ct
            '${1} Cove',            // Cv
            '${1} Canyon',          // Cy
            '${1} Canyon',          // Cyn
            '${1} Drive',           // Dr
            '${1} Glen',            // Gl
            '${1} Glen',            // Gln
            '${1} Grade',           // Gr Grade or Grove
            '${1} Haven',           // Hvn
            '${1} Highway',         // Hw
            '${1} Highway',         // Hwy
            '${1} Heights',         // Hts
            '${1} Highway',         // Hy
            '${1} Knoll',           // Knl
            '${1} Lane',            // La
            '${1} Lane',            // Ln
            '${1} Loop',            // Lo
            '${1} Loop',            // Lp
            '${1} North',           // N
            '${1} Orchard',         // Orch
            '${1} Pass',            // Pa
            '${1} Parkway',         // Pk
            '${1} Parkway',         // Pkwy
            '${1} Place',           // Pl
            '${1} Port',            // Prt
            '${1} Point',           // Pt
            '${1} Parkway',         // Py
            '${1} Road',            // Rd
            '${1} Ridge',           // Rdg
            '${1} Row',             // Ro
            '${1} Row',             // Rw
            '${1} Square',          // Sq
            '${1} Street',          // St
            '${1} Street',          // St.
            '${1} Terrace',         // Te
            '${1} Terrace',         // Ter
            '${1} Trail',           // Tl
            '${1} Terrace',         // Tr Terrace or Trail
            '${1} Trail',           // Trl
            '${1} Truck Trail',     // Tt
            '${1} View',            // Vw
            '${1} West',            // W
            '${1} Way',             // Wa
            '${1} Walk',            // Wl
            '${1} Walk',            // Wk
            '${1} Way',             // Wy
            '${1} Crossing',        // Xi

            // Special cases
            '${1} El Camino Real',
            'E Avenue',
            'E Street',
          );

/*
 *  Find and replace abbreviations in addr:unit
 */
$unitAbbrev = array(
          // Prefixes
          '/^Apt (.*)/i',
          '/^Bldg (.*)/i',
          '/^Spc (.*)/i',
          '/^Ste (.*)/i',
          '/^Trlr (.*)/i',
      );
$unitExpanded = array(
          // Prefixes
          'Apartment ${1}',         // Apt
          'Building ${1}',          // Bldg
          'Space ${1}',             // Spc
          'Suite ${1}',             // Ste
          'Trailer ${1}',           // Trlr
      );

$directionals = array(
        'E' => 'East',
        'N' => 'North',
        'Ne' => 'Northeast',
        'Nw' => 'Northwest',
        'S' => 'South',
        'Se' => 'Southeast',
        'Sw' => 'Southeast',
        'W' => 'West',
);

$intermediates = array(
    'Cv' => 'Cove',
    'Gl' => 'Glen',
    'Gln' => 'Glen',
    'Grv' => 'Grove',
    'Hl' => 'Hill',
    'Mdw' => 'Meadow',
    'Mdws' => 'Meadows',
    'Pa' => 'Pass',
    'Spgs' => 'Springs',
    'Vw' => 'View',
);

$suffixes = array(
    'St' => 'Street',
    'Av' => 'Avenue',
    'Ave' => 'Avenue',
    'Bl' => 'Boulevard',
    'Blvd' => 'Boulevard',
    'Ci' => 'Circle',
    'Cir' => 'Circle',
    'Cr' => 'Circle',
    'Ct' => 'Court',
    'Dr' => 'Drive',
    'Gr' => 'Grade',
    'Hw' => 'Highway',
    'Hwy' => 'Highway',
    'Hy' => 'Highway',
    'La' => 'Lane',
    'Ln' => 'Lane',
    'Lo' => 'Loop',
    'Lp' => 'Loop',
    'Pk' => 'Parkway',
    'Pkwy' => 'Parkway',
    'Pl' => 'Place',
    'Pt' => 'Point',        // Might also be Pointe
    'Py' => 'Parkway',
    'Rd' => 'Road',
    'Ro' => 'Row',
    'Rw' => 'Row',
    'Sq' => 'Square',
    'St' => 'Street',
    'St.' => 'Street',
    'Te' => 'Terrace',
    'Ter' => 'Terrace',
    'Tl' => 'Trail',
    'Tr' => 'Terrace',      // Might also be Trail
    'Trl' => 'Trail',
    'Tt' => 'Truck Trail',
    'Wa' => 'Way',
    'Wl' => 'Walk',
    'Wk' => 'Walk',
    'Wy' => 'Way',
    'Xi' => 'Crossing',
);

$secondaryIdentifiers = array(
    'Apt' => 'Apartment',
    'Bldg' => 'Building',
    'Spc' => 'Space',
    'Ste' => 'Suite',
    'Trlr' => 'Trailer',
    'Unit' => 'Unit',
);

/*
 *  Special case word pairs.
 *
 *  We have troubles with words like "la". If at the
 *  end of the street name portion it is an Official
 *  abbreviation for "Lane". But it might be a Spanish
 *  word in the middle of the street name (e.g. "Calle la Veta")
 */

$specialPhrases = array(
          'Calle La ',
          ' De La ',
      );
$specialUnderscore = array(
          'Calle_La ',
          ' De_La ',
      );

/*
 *  ZIP cities from https://tools.usps.com/zip-code-lookup.htm?citybyzipcode
 */
$zipCity = array(
    '90620' => 'Buena Park',
    '90621' => 'Buena Park',
    '90623' => array('La Palma','Buena Park'),
    '90630' => 'Cypress',
    '90631' => array('La Habra','La Habra Heights'),
    '90638' => 'La Mirada',
    '90680' => 'Stanton',
    '90720' => array('Los Alamitos','Cypress','Rossmoor'),
    '90740' => 'Seal Beach',
    '90742' => 'Sunset Beach',
    '90743' => 'Surfside',
    '90808' => 'Long Beach',
    '90815' => 'Long Beach',
    '91901' => 'Alpine',
    '91902' => 'Bonita',
    '91905' => 'Boulevard',
    '91906' => 'Campo',
    '91910' => 'Chula Vista',
    '91911' => 'Chula Vista',
    '91913' => 'Chula Vista',
    '91914' => 'Chula Vista',
    '91915' => 'Chula Vista',
    '91916' => 'Descanso',
    '91917' => 'Dulzura',
    '91931' => 'Guatay',
    '91932' => 'Imperial Beach',
    '91934' => 'Jacumba',
    '91935' => 'Jamul',
    '91941' => 'La Mesa',
    '91942' => 'La Mesa',
    '91945' => 'Lemon Grove',
    '91948' => 'Mount Laguna',
    '91950' => 'National City',
    '91962' => 'Pine Valley',
    '91963' => 'Potrero',
    '91977' => 'Spring Valley',
    '91978' => 'Spring Valley',
    '91980' => 'Tecate',
    '92003' => 'Bonsall',
    '92004' => 'Borrego Springs',
    '92007' => 'Cardiff-By-The-Sea',
    '92008' => 'Carlsbad',
    '92009' => 'Carlsbad',
    '92010' => 'Carlsbad',
    '92011' => 'Carlsbad',
    '92014' => 'Del Mar',
    '92018' => 'Carlsbad',
    '92019' => 'El Cajon',
    '92020' => 'El Cajon',
    '92021' => 'El Cajon',
    '92024' => 'Encinitas',
    '92025' => 'Escondido',
    '92026' => 'Escondido',
    '92027' => 'Escondido',
    '92028' => 'Fallbrook',
    '92029' => 'Escondido',
    '92036' => 'Julian',
    '92037' => 'La Jolla',
    '92039' => 'La Jolla',
    '92040' => 'Lakeside',
    '92054' => 'Oceanside',
    '92055' => 'Camp Pendleton',
    '92056' => 'Oceanside',
    '92057' => 'Oceanside',
    '92058' => 'Oceanside',
    '92059' => 'Pala',
    '92060' => 'Palomar Mountain',
    '92061' => 'Pauma Valley',
    '92064' => 'Poway',
    '92065' => 'Ramona',
    '92066' => 'Ranchita',
    '92067' => 'Rancho Santa Fe',
    '92069' => 'San Marcos',
    '92070' => 'Santa Ysabel',
    '92071' => 'Santee',
    '92075' => 'Solana Beach',
    '92078' => 'San Marcos',
    '92081' => 'Vista',
    '92082' => 'Valley Center',
    '92083' => 'Vista',
    '92084' => 'Vista',
    '92086' => 'Warner Springs',
    '92091' => 'Rancho Santa Fe',
    '92093' => 'La Jolla',
    '92096' => 'San Marcos',
    '92101' => 'San Diego',
    '92102' => 'San Diego',
    '92103' => 'San Diego',
    '92104' => 'San Diego',
    '92105' => 'San Diego',
    '92106' => 'San Diego',
    '92107' => 'San Diego',
    '92108' => 'San Diego',
    '92109' => 'San Diego',
    '92110' => 'San Diego',
    '92111' => 'San Diego',
    '92113' => 'San Diego',
    '92114' => 'San Diego',
    '92115' => 'San Diego',
    '92116' => 'San Diego',
    '92117' => 'San Diego',
    '92118' => 'Coronado',
    '92119' => 'San Diego',
    '92120' => 'San Diego',
    '92121' => 'San Diego',
    '92122' => 'San Diego',
    '92123' => 'San Diego',
    '92124' => 'San Diego',
    '92126' => 'San Diego',
    '92127' => 'San Diego',
    '92128' => 'San Diego',
    '92129' => 'San Diego',
    '92130' => 'San Diego',
    '92131' => 'San Diego',
    '92135' => 'San Diego',
    '92136' => 'San Diego',
    '92137' => 'San Diego',
    '92139' => 'San Diego',
    '92140' => 'San Diego',
    '92145' => 'San Diego',
    '92154' => 'San Diego',
    '92173' => 'San Ysidro',
    '92182' => 'San Diego',
    '92509' => 'Jurupa Valley',
    '92530' => 'Lake Elsinore',
    '92536' => 'Aguanga',
    '92592' => 'Temecula',
    '92602' => 'Irvine',
    '92603' => 'Irvine',
    '92604' => 'Irvine',
    '92606' => 'Irvine',
    '92610' => array('Foothill Ranch','El Toro','Lake Forest'),
    '92612' => 'Irvine',
    '92614' => 'Irvine',
    '92617' => 'Irvine',
    '92618' => 'Irvine',
    '92620' => 'Irvine',
    '92624' => array('Capistrano Beach','Capo Beach','Dana Point'),
    '92625' => 'Corona Del Mar',
    '92626' => 'Costa Mesa',
    '92627' => 'Costa Mesa',
    '92629' => array('Dana Point','Monarch Bay','Monarch Beach'),
    '92630' => array('Lake Forest','El Toro'),
    '92637' => array('Laguna Woods','Laguna Hills'),
    '92646' => 'Huntington Beach',
    '92647' => 'Huntington Beach',
    '92648' => 'Huntington Beach',
    '92649' => 'Huntington Beach',
    '92651' => 'Laguna Beach',
    '92653' => array('Laguna Hills','Aliso Viejo','Laguna Beach','Laguna Woods'),
    '92655' => 'Midway City',
    '92656' => array('Aliso Viejo','Laguna Beach','Laguna Hills'),
    '92657' => array('Newport Coast','Newport Beach'),
    '92660' => 'Newport Beach',
    '92661' => 'Newport Beach',
    '92662' => array('Newport Beach','Balboa','Balboa Island'),
    '92663' => 'Newport Beach',
    '92672' => 'San Clemente',
    '92673' => 'San Clemente',
    '92674' => 'San Clemente',
    '92675' => array('San Juan Capistrano','Mission Viejo'),
    '92676' => 'Silverado',
    '92677' => array('Laguna Niguel','Laguna Beach'),
    '92679' => array('Trabuco Canyon','Coto De Caza','Dove Canyon','Lake Forest','Portola Hills','Robinson Ranch'),
    '92683' => 'Westminster',
    '92688' => 'Rancho Santa Margarita',
    '92691' => array('Mission Viejo','San Juan Capistrano'),
    '92692' => array('Mission Viejo','San Juan Capistrano'),
    '92694' => array('Ladera Ranch','Mission Viejo','Rancho Mission Viejo'),
    '92701' => 'Santa Ana',
    '92703' => 'Santa Ana',
    '92704' => 'Santa Ana',
    '92705' => array('Santa Ana','Cowan Heights','North Tustin'),
    '92706' => 'Santa Ana',
    '92707' => 'Santa Ana',
    '92708' => array('Fountain Valley','Santa Ana'),
    '92780' => 'Tustin',
    '92782' => 'Tustin',
    '92801' => 'Anaheim',
    '92802' => 'Anaheim',
    '92803' => 'Anaheim',
    '92804' => 'Anaheim',
    '92805' => 'Anaheim',
    '92806' => 'Anaheim',
    '92807' => 'Anaheim',
    '92808' => 'Anaheim',
    '92821' => 'Brea',
    '92823' => 'Brea',
    '92831' => 'Fullerton',
    '92832' => 'Fullerton',
    '92833' => 'Fullerton',
    '92835' => 'Fullerton',
    '92840' => 'Garden Grove',
    '92841' => 'Garden Grove',
    '92843' => 'Garden Grove',
    '92844' => 'Garden Grove',
    '92845' => 'Garden Grove',
    '92861' => array('Villa Park','Orange'),
    '92865' => 'Orange',
    '92866' => 'Orange',
    '92867' => array('Orange','Villa Park'),
    '92868' => 'Orange',
    '92869' => 'Orange',
    '92870' => 'Placentia',
    '92886' => 'Yorba Linda',
    '92887' => 'Yorba Linda',
);

$unknownZIP = array();
$changedCities = array();

/*
 *  Return postal city given ZIP code and optional current city name.
 *
 *  If the current city name is one of the “OTHER CITY NAMES RECOGNIZED
 *  FOR ADDRESSES IN THIS ZIP CODE” then return it. Otherwise return the
 *  “RECOMMENDED CITY NAME” for the ZIP code.
 */
function postalCity($zip, $city='') {
    global $zipCity, $unknownZIP, $changedCities;

    $rslt = $city;

    if (isset($zipCity[$zip])) {
        $candidates = $zipCity[$zip];
        $match = false;
        $newCity = '';
        if (is_array($candidates)) {
            $match = ($city != '') && in_array($city, $candidates);
            $newCity = $candidates[0];
        } else {
            $match = ($city == $candidates);
            $newCity = $candidates;
        }
        if (!$match) {
            $changedCities["$zip: $rslt => $newCity"] = 1;
            $rslt = $newCity;
        }
    } else {
        $unknownZIP[$zip] = 1;
    }
    return $rslt;
}

/*
 *  Return boolean based on if the token is valid as part of
 *  a house number. Basically extend is_numeric() to also
 *  a '/' character. This allows us to treat “123 1/2” as a
 *  valid street number. (Gives errors in OSM QA tools but is
 *  a legitimate US house number.)
 */
function validStreetNumber($v) {
    $rslt = is_numeric($v);
    if (!$rslt) {
        $rslt = true;
        for ($i = 0; $i < strlen($v); $i++){
            $rslt &= (strpos('0123456789/',$v[$i]) !== false);
        }
    }
    return $rslt;
}

/*
 *  Parse an input house number of the form
 *  “123 1/2 S MAIN ST APT 37” into the following tags:
 *
 *  addr:housenumber = “123 1/2”
 *  addr:street = “South Main Street”
 *  addr:unit = “Apartment 37”
 *
 *  See: https://pe.usps.com/text/pub28/28c2_012.htm#ep526349
 *
 *  The post office defines the address as consisting of:
 *      primary address number          --> 123 1/2
 *      predirectional                  --> S
 *      street name                     --> MAIN
 *      suffix                          --> ST
 *      postdirectional                 --> Could be N, S, E, W, etc.
 *      secondary address identifier    --> APT
 *      secondary address               --> 37
 *
 *  For OSM purposes:
 *      Primary address number is addr:housenumber.
 *
 *      Predirectional, street name, suffix and postdirectional are
 *      in addr:street.
 *
 *      Secondary address identifier and secondary address are
 *      in addr:unit.
 */
function parseAddress($address) {
    global $abbrev, $expanded;
    global $unitAbbrev, $unitExpanded;
    global $specialPhrases,$specialUnderscore;
    global $directionals, $suffixes, $secondaryIdentifiers;
    global $intermediates;

    $tags = array();

    $state = 'number';
    $number = '';
    $predirectional = '';
    $streetName = '';
    $unit = '';

    /*
     * convert spaces to underscores on special phrases
     * so that things like 'calle la whatever' don't get
     * turned into 'calle lane'. We will convert them back
     * later.
     */
    $normalizedAddress = ucwords(strtolower($address));
    $normalizedAddress = str_replace($specialPhrases, $specialUnderscore, $normalizedAddress);

    $tokens = explode(' ',$normalizedAddress);
    foreach ($tokens as $t) {
        /*
         * See if current part is compatible with
         * our current state.
         */
        switch ($state) {
            case 'number':
                if (validStreetNumber($t)) {
                    $number = $t . ' ';
                } else {
                    if (isset($intermediates[$t])) {
                        $t = $intermediates[$t]  . ' ';
                    }
                    if (isset($directionals[$t])) {
                        $predirectional = $directionals[$t] . ' ';
                    } else {
                        $streetName = $t . ' ';
                    }
                    $state = 'street';
                }
            break;

            case 'street':
                if (isset($intermediates[$t])) {
                    $t = $intermediates[$t]  . ' ';
                }
                if ($streetName == '') {
                    $streetName = $t . ' ';
                } else {
                    if (isset($suffixes[$t])) {
                        $streetName .= $suffixes[$t]  . ' ';
                        $state = 'postdir';
                    } else if (in_array($t, $suffixes)) {
                        $streetName .= $t  . ' ';
                        $state = 'postdir';
                    } else if (isset($directionals[$t])) {
                        $streetName .= $directionals[$t]  . ' ';
                        $state = 'unit';
                    } else if (isset($directionals[$t])) {
                        $streetName .= $directionals[$t]  . ' ';
                        $state = 'unit';
                    } else if (in_array($t, $directionals)) {
                        $streetName .= $t  . ' ';
                        $state = 'unit';
                    } else if (isset($secondaryIdentifiers[$t])) {
                        $unit .= $secondaryIdentifiers[$t]  . ' ';
                        $state = 'unit';
                    } else if (in_array($t, $secondaryIdentifiers)) {
                        $unit .= $t  . ' ';
                        $state = 'unit';
                    } else if (is_numeric($t)) {
                        $unit .= $t  . ' ';
                        $state = 'unit';
                    } else if (strlen($t) == 1) { // 'A', 'B', etc.
                        $unit .= $t  . ' ';
                        $state = 'unit';
                    } else {
                        $streetName .= $t . ' ';
                    }
                }
            break;

            case 'postdir':
                if (isset($directionals[$t])) {
                    $streetName .= $directionals[$t]  . ' ';
                } else if (in_array($t, $directionals)) {
                    $streetName .= $t  . ' ';
                } else {
                    if (isset($secondaryIdentifiers[$t])) {
                        $unit .= $secondaryIdentifiers[$t]  . ' ';
                    } else {
                        $unit .= $t  . ' ';
                    }
                }
                $state = 'unit';
            break;

            case 'unit':
                if (isset($secondaryIdentifiers[$t])) {
                    $unit .= $secondaryIdentifiers[$t]  . ' ';
                } else {
                    $unit .= $t  . ' ';
                }
            break;
        }
    }

    if ($number != '') {
        $tags['addr:housenumber'] = trim($number);
    }
    /*
     *  Covert the underscores in our special phrases back
     *  into spaces.
     */
    $street = trim($predirectional . str_replace('_',' ',$streetName));


    $tags['addr:street'] = preg_replace($abbrev, $expanded, $street);
    if ($unit != '') {
        $unit = trim($unit);
        $tags['addr:unit'] = preg_replace($unitAbbrev, $unitExpanded, $unit);
    }

    if (false && $unit != '') {
        fprintf(STDERR,"%s => %s".PHP_EOL, $address, serialize($tags));
        fprintf(STDERR,"\tNumber: %s".PHP_EOL,$number);
        fprintf(STDERR,"\tPredirectional: %s".PHP_EOL,$predirectional);
        fprintf(STDERR,"\tStreetName: %s".PHP_EOL,$streetName);
        fprintf(STDERR,"\tUnit: %s".PHP_EOL,$unit);
        exit();
    }
    return $tags;
}

/*
 *  Output some statistics about city names that have been changed based
 *  on the ZIP code. Also list any unknown ZIP codes found in the data.
 */
function addressFixStats($stream) {
    global $unknownZIP, $changedCities;

    if (sizeof($unknownZIP) > 0){
        ksort($unknownZIP);
        fprintf($stream, "Unknown ZIP Codes:".PHP_EOL);
        foreach ($unknownZIP as $zip => $dummy) {
            fprintf(STDERR,"\t%s".PHP_EOL, $zip);
        }
    }
    if (sizeof($changedCities) > 0){
        ksort($changedCities);
        fprintf($stream, "Changed Citys:".PHP_EOL);
        foreach ($changedCities as $cityInfo => $dummy) {
            fprintf($stream, "\t%s".PHP_EOL, $cityInfo);
        }
    }
}
?>
