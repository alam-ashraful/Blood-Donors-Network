<?php
/*
    {source, destination, distance}
*/

     require ('GetUserInformation.php');
     $row = GetDistanceVectorTableValue();
$edges =
        array(
        	// while($r = $row->fetch_assoc())
        	// {
         //      	array(echo $r['FromDistance'], echo $r['ToDistance'], echo $r['PathCost'])
        	// }
            array(0, 1, 5),
            array(0, 2, 8),
            array(0, 3, -4),
            array(1, 0, -1),
            array(2, 1, -3),
            array(2, 3, 9),
            // array(3, 1, 7),
            // array(3, 4, 2),
            // array(4, 0, 6),
            // array(4, 2, 7),
            // array(4, 1, 3),
            // array(5, 1, -3),
            // array(4, 5, -3),
        );

        // Dv(dist) = {cost(v,dist)+Ddist(dist)}

BELLMAN_FORD($edges, count($edges), 6, 4);

function BELLMAN_FORD($edges, $edgecount, $nodecount, $source)
{
    // Initialize distances
    $distances = array();

    // This is the INITIALIZE-SINGLE-SOURCE function.
    for($i = 0; $i < $nodecount; ++$i)
        $distances[$i] = INF; // All distances should be set to INFINITY

    $distances[$source] = 0; // The source distance should be set to 0.

    // Do what we are suppose to do, This is the BELLMAN-FORD function
    for($i = 0; $i < $nodecount; ++$i)
    {
        $somethingChanged = false; // If nothing has changed after one pass, it will not change after two.
        for($j = 0; $j < $edgecount; ++$j)
        {
            if($distances[$edges[$j][0]] != INF) // Check so we are not doing something stupid
            {
                $newDist = $distances[$edges[$j][0]] + $edges[$j][2]; // Just create a temporary variable containing the calculated distance
                if($newDist < $distances[$edges[$j][1]]) // If the new distance is shorter than the old one, we've found a new shortest path
                {
                    $distances[$edges[$j][1]] = $newDist;
                    $somethingChanged = true; // SOMETHING CHANGED, YEY!
                }
            }
        }
        // If $somethingChanged == FALSE, then nothing has changed and we can go on with the next step.
        if(!$somethingChanged) break;
    }

    // Check the graph for negative weight cycles
    // for($i = 0; $i < $edgecount; ++$i)
    // {
    //     if($distances[$edges[$i][1]] > $distances[$edges[$i][0]] + $edges[$i][2])
    //     {
    //         echo "Negative edge weight cycle detected!";
    //         return;
    //     }
    // }

    // Print out the shortest distance
    for($i = 0; $i < $nodecount; ++$i)
    {
        echo "<br />Shortest distance between nodes " . $source . " and " . $i . " is " . $distances[$i] . "
";
    }

    return;
}
?>