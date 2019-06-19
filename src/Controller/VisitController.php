<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use DateTime;


class VisitController extends AbstractController{

    public function getAggregatedVisits($watchedLinkId, $start, $end, $scale = "d"){
        // Date format for where clause
        $dateFormat = "YmdHis";

        // Formatting dates
        $startDateTimeObject = new DateTime($start);
        $startDateTimeString = $startDateTimeObject->format($dateFormat);
        $endDateTimeObject = new DateTime($end);
        $endDateTimeString = $endDateTimeObject->format($dateFormat);

        // Formatting scale 
        $mysqlScale = substr($dateFormat, 0, strpos($dateFormat,$scale)+1);
        $mysqlScale = preg_replace('/[a-zA-Z]/', '%$0:', $mysqlScale);
        $mysqlScale = substr($mysqlScale, 0, -1);

        // Getting request
        $sql = 'SELECT COUNT(id) as visits, DATE_FORMAT(time, :mysqlScale) as datetime FROM visit WHERE (time BETWEEN :startDateTimeString AND :endDateTimeString) AND watched_link_id = :watchedLinkId GROUP BY DATE_FORMAT( time, :mysqlScaleSame)';
        $connection = $this->getDoctrine()->getEntityManager()->getConnection();
        $stmt = $connection->prepare($sql);
        $stmt->execute([
            'mysqlScale'            => $mysqlScale,
            'startDateTimeString'   => $startDateTimeString,
            'endDateTimeString'     => $endDateTimeString,
            'watchedLinkId'         => $watchedLinkId,
            'mysqlScaleSame'        => $mysqlScale,
        ]);

        // Get all visits
        $visits = $stmt->fetchAll();

        // Send agregatted data to front. Json is used for Ajax responses
        return new JsonResponse($visits);
    }
}

?>