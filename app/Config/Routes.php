<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Login');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

//JWT-no funcional
//$routes->resource('api/auth', ['controller' => 'Auth']);
//$routes->resource('api/user', ['controller' => 'User']);

//grupo para procesos del usuario
$routes->group("api", function ($routes) {

    $routes->post("existe_correo", "User::existe_correo");
    $routes->post("register", "User::createUser");
    $routes->post("logeo", "User::validateUser");
    $routes->get("userdata", "User::userDetails");
    
});

//grupo para procesos de las HSO
$routes->group("api/hso", function ($routes) {

    $routes->get("alldata", "Hso::getallHso");
    $routes->post("buscar", "Hso::detailsHso");
    $routes->post("crear", "Hso::insertHso");
    $routes->post("editar", "Hso::updateHso");
    $routes->post("eliminar", "Hso::deleteHso");
    
});

//grupo para procesos de la unidad de servicios de salud
$routes->group("api/uss", function ($routes) {

    $routes->get("alldata", "Uss::getallUss");
    $routes->post("buscar", "Uss::detailsUss");
    $routes->post("crear", "Uss::insertUss");
    $routes->post("editar", "Uss::updateUss");
    $routes->post("eliminar", "Uss::deleteUss");
    $routes->post("fkagrupado", "Uss::detail_x_fk");
    $routes->get("countalluss", "Uss::countallUss");
    
});

//grupo para procesos del grupo de servicios
$routes->group("api/gus", function ($routes) {

    $routes->get("alldata", "Gus::getallGus");
    $routes->post("buscar", "Gus::detailsGus");
    $routes->post("crear", "Gus::insertGus");
    $routes->post("editar", "Gus::updateGus");
    $routes->post("eliminar", "Gus::deleteGus");
    $routes->post("fkagrupado", "Gus::detail_x_fk");
    $routes->get("countallgus", "Gus::countallGus");
    
});

//grupo para servicios ofertado por grupo
$routes->group("api/svo", function ($routes) {

    $routes->get("alldata", "Svo::getallSvo");
    $routes->post("buscar", "Svo::detailsSvo");
    $routes->post("crear", "Svo::insertSvo");
    $routes->post("editar", "Svo::updateSvo");
    $routes->post("eliminar", "Svo::deleteSvo");
    $routes->post("fkagrupado", "Svo::detail_fk");
    $routes->get("countallsvo", "Svo::countallSvo");
    
});

//grupo para perfil de estudiante
$routes->group("api/perfilest", function ($routes) {

    $routes->get("alldata", "Perfil::getallPerf");
    $routes->post("buscar", "Perfil::detailsPerf");
    $routes->post("crear", "Perfil::insertPerf");
    $routes->post("editar", "Perfil::updatePerf");
    $routes->post("eliminar", "Perfil::deletePerf");
    $routes->post("fkagrupado", "Perfil::detail_fk_Perf");
    $routes->get("countallprf", "Perfil::countallPerf");
    
});

//grupo para programas por servicio
$routes->group("api/programa", function ($routes) {

    $routes->get("alldata", "Programa::getallProg");
    $routes->post("buscar", "Programa::detailsProg");
    $routes->post("crear", "Programa::insertProg");
    $routes->post("editar", "Programa::updateProg");
    $routes->post("eliminar", "Programa::deleteProg");
    $routes->post("fkagrupado", "Programa::detail_fk");
    $routes->get("countall", "Programa::countallProg");
    
});

//grupo para programas por servicio
$routes->group("api/estandar", function ($routes) {

    $routes->get("alldata", "Estandar::getallEst");
    $routes->post("buscar", "Estandar::detailsEst");
    $routes->post("crear", "Estandar::insertEst");
    $routes->post("editar", "Estandar::updateEst");
    $routes->post("eliminar", "Estandar::deleteEst");
    $routes->post("fkagrupado", "Estandar::detail_fk");
    $routes->get("countestprog", "Estandar::graph_Estudi");
    
});

//grupo para capacidad de la unidad de servicios
$routes->group("api/capacidaduus", function ($routes) {

    $routes->get("alldata", "Capacidaduus::getallCapuss");
    $routes->post("buscar", "Capacidaduus::detailsCapuss");
    $routes->post("crear", "Capacidaduus::insertCapuss");
    $routes->post("editar", "Capacidaduus::updateCapuss");
    $routes->post("eliminar", "Capacidaduus::deleteCapuss");
    
});

//grupo para capacidad instalada
$routes->group("api/asociacion", function ($routes) {

    //$routes->get("alldata", "Formcapinstalada::getallDatainstalada");
    $routes->post("crear", "UssGusSvoProgPerf::insertUGSPP");
    $routes->post("editar", "UssGusSvoProgPerf::updateUGSPP");
});

//grupo para los datos de la unidad de servicios
$routes->group("api/datosuss", function ($routes) {

    //$routes->get("alldata", "Formcapinstalada::getallDatainstalada");
    $routes->post("crear", "UssGusSvoProgPerf::insertUGSPP");
    $routes->post("editar", "UssGusSvoProgPerf::updateUGSPP");
});


//grupo para capacidad instalada
$routes->group("api/capmedinstall", function ($routes) {

    $routes->get("alldata", "Formcapinstalada::getallDatainstalada");
    $routes->post("crear", "Formcapinstalada::insertDatainstalada");
    $routes->get("countdoceprog", "Formcapinstalada::graph_Docen");
    $routes->post("buscar", "Formcapinstalada::detailsCapMesIns");
    
    /*
    $routes->post("editar", "Formcapinstalada::updateCapUss");
    $routes->post("eliminar", "Formcapinstalada::deleteCapUss");*/
    
});

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//principal
$routes->get('/', 'Login::index');
$routes->get('/logout', 'User::cerrarSesion');
//vistas
$routes->get("/", "Home::index");
$routes->get("/", "Uss::index");
$routes->get("/", "Hso::index");
$routes->get("/", "Estandar::index");
$routes->get("/datosussv", "Capacidaduus::index");
$routes->get("/capinstalada", "Formcapinstalada::index");
$routes->get("/formcapinstalada", "Formcapinstalada::formulario");


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
