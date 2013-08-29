<?php 

namespace PushOn;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use \Core\Mailer;

/** Homepage */
$app->match('/', function() use ( $app ) {

    $base = new \Core\APIs\BaseApi;
    $all = $base->getAllSifterInstances();

    // de( $all );

	$content = $app['twig']->render('index.html.twig', array(
        'all'   => $all,
        'pname' => $pname
    ));

	return new Response ( $content );
});

/** Basecamp - Developer hours */
$dev_time = $app['controllers_factory'];
$dev_time->get('/{developer}', function( $developer ) use ( $app ) {

	$time = new \Core\APIs\BaseApi;
	$total = $time->getTotalSifterTimePerDeveloper( $developer );

	$content = $app['twig']->render('sifter_times.html.twig', array(
		'total' => $total
	));

	return new Response ( $content );
});
$app->mount('/sifter/hours', $dev_time);

/** Basecamp - Developer hours - E-Mail Report */
$mail_time = $app['controllers_factory'];
$mail_time->get('{developer}/{email}', function( $developer, $email ) use ( $app ) {
	$time = new \Core\APIs\BaseApi;
	$res = $time->getTotalSifterTimePerDeveloper( $developer );

	$mail = new Mailer();

	$mail->send( 
		$email, 
		'Developer Sifter Hours - Report', 
		$res
	);

	return new Response ( $res );

});
$app->mount('/sifter/hours', $mail_time);

/** Basecamp - Project hours */
$hours_project = $app['controllers_factory'];
$hours_project->get('/{id}', function ( $id ) use ( $app ) {
	$base = new \Core\APIs\BaseApi;

	$times = $base->getSifterTimesPerProject( $id );
	$total = $base->getTotalSifterTimePerProject( $id );
	$pname = $base->getProjectName( $id );

	if ( is_null( $times ) ) {
		$content = 'No times found...';
	} else {
		$content = $app['twig']->render('sifter_times.html.twig', array(
			'times' => $times,
			'total' => $total,
			'pname' => $pname
		));
	}

	return new Response ( $content );

});
$app->mount('/sifter/times/project/', $hours_project);

/** @todo Basecamp - Project hours - E-Mail report */

/** @todo Basecamp - Project hours per developer */

/** @todo Basecamp - Project hours per developer - E-Mail report */

/** Sifter - Unresolved Tickets */
$app->get('/sifter/unresolved', function() use( $app ) {

	$sifter = new \Core\APIs\SifterApi;
	$issues = $sifter->getOustandingIssues();

	$content = $app['twig']->render('sifter_unresolved.html.twig', array(
		'issues' => $issues
	));

	return new Response ( $content );
});

/** Sifter - Unresolved Tickets - E-Mail report */
$mail_unresolved = $app['controllers_factory'];
$mail_unresolved->get('/{email}', function( $email ) use ( $app ){

	$sifter = new \Core\APIs\SifterApi;
	$issues = $sifter->getOustandingIssues();

	$content = $app['twig']->render('sifter_unresolved.html.twig', array(
		'issues' => $issues
	));

	$mail = new Mailer();

	$send = $mail->send(
		$email,
		'Unresolved Issues Report',
		$content
	);

	return new Response ( $send );
});
$app->mount('/sifter/unresolved', $mail_unresolved);

/** @todo Sifter - Unresolved Tickets - Developer */

/** @todo Sifter - Unresolved Tickets - Developer - E-Mail Report */

/** @todo Sifter - Unresolved Tickets - Date range */

/** @todo Sifter - Unresolved Tickets - Date range - E-Mail Report */

/** Testing the contacts selector */
$contacts = $app['controllers_factory'];
$contacts->get('/', function() use ( $app ) {
	
	$contacts = new \Core\Helpers\Contacts( $app['config.path'] );
	$contacts = $contacts->getAllAdminContacts();

	// var_dump( $contacts );

	$content = $app['twig']->render('contacts.html.twig', array(
		'contacts' => $contacts
	));

	return new Response ( $content );
});
$app->mount('/contacts', $contacts);

$mot = $app['controllers_factory'];
$mot->get('/', function() use ( $app ) {

	$controller = new Controllers\TestController();
	$view = $controller->getView();

	return new Response( $view );

});
$app->mount('/mot', $mot);

$app->get('/test2', function() use ( $app ) {
	$controller = new Controllers\TestController( $app );
	$view = $controller->getView();

	return new Response ( $view );
});

$app->get('/tester', function() use ($app) {

	$base = new APIs\BaseApi;
	$data = $base->getReportsForAllProjects( array(11036004, 10787008) );

	$content = $app['twig']->render('full_report.html.twig', array(
		'data' => $data
	));

	return new Response( $content );
});