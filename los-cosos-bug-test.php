<?php
if ($_GET['getSearch'] == 1) {
    $userCoords = (isset($_COOKIE['geo_coords'])) ? $_COOKIE['geo_coords'] : null;
    $solr = new SolrImpl();
    $query = 'handler?fq=' . rawurlencode('categ:"' . trim($categ)) . rawurlencode('"') . '&fq=' . urlencode('featuredpos:[1 TO *]') . '&rows=10';
    $response_solr = $solr->getSearchResults($query);
    $solr_response = json_decode($response_solr);
    $count = $solr_response->response->numFound;
    $rand_start = ($count > 10) ? intval(rand(0, $count - 10)) : 0;
    $filter_coords = '';
    if (isset($userCoords)) {
        $coords = str_replace(' ', '_', trim($userCoords));
        $filter_coords = '&pt=' . $coords;
        $filter_coords .= '&sfield=coords';
        $filter_coords .= '&fl=' . rawurlencode('*,score,_dist_:geodist()');
    }
    $query = 'handler?fq=' . rawurlencode('categ:"' . trim($categ)) . rawurlencode('"') . '&fq=' . urlencode('featuredpos:[1 TO *]') . '&start=' . $rand_start . $filter_coords . '&rows=10';
    $response_solr = $solr->getSearchResults($query);
    $solr_response = json_decode($response_solr);
} else {
    $solr_response = new stdClass();
    $solr_response->response->numFound = 0;
}
header('Content-type: text/plain; charset=utf-8');
print_r($solr_response);
exit();
?>