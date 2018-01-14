<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Point;
use App\Statistic;

use Unlu\Laravel\Api\QueryBuilder;

class PointController extends Controller
{
    public function index(Request $request)
    {
        $queryBuilder = new QueryBuilder(new Point, $request);
        
        // Single Point
        if($request->limit && $request->limit == 1)
        {
            $point = json_decode("{}");
            $status = 0;
            if(isset($queryBuilder->build()->get()[0]))
            {
                $point = $queryBuilder->build()->get()[0];
                $status = 200;

                // Get point statistics.
                $statistic = Statistic::where('point_id',$point->id)->first();
                $point->statistic = $statistic;

                $previous_statistic = Statistic::where('point_id',$point->previous_point_id)->first();
                $point->previous_point_statistic = $previous_statistic;

                $next_statistic = Statistic::where('point_id',$point->next_point_id)->first();
                $point->next_point_statistic = $next_statistic;
            }
            else
            {
                $status = 404;
            }
            return response()->json([
                'status' => $status,
                'point' => $point
            ],200);
        }
        else
        {
            $points = $queryBuilder->build()->get();
            $status = 0;
            
            if($points && count($points) > 0){
                $status = 200;

                for($x=0; $x<count($points); $x++){
                    // Get points statistics.
                    $statistic = Statistic::where('point_id',$points[$x]->id)->first();
                    $points[$x]->statistic = $statistic;

                    $previous_statistic = Statistic::where('point_id',$points[$x]->previous_point_id)->first();
                    $points[$x]->previous_point_statistic = $previous_statistic;

                    $next_statistic = Statistic::where('point_id',$points[$x]->next_point_id)->first();
                    $points[$x]->next_point_statistic = $next_statistic;
                }
            }
            else $status = 404;
            return response()->json([
                'status' => $status,
                'points' => $points
            ],200);
        }
    }

    public function show(Point $point)
    {
        $status = "";
        if($point) $status = 200;
        else $status = 404;
        return response()->json([
            'status' => $status,
            'point' => $point
        ], 200);
    }

    public function store(Request $request)
    {
        $point = Point::create($request->all());
        return response()->json([
            'status' => 201,
            'point' => $point
        ], 201);
    }

    public function update(Request $request, Point $point)
    {
        $point->update($request->all());
        return response()->json([
            'status' => 200,
            'point' => $point
        ], 200);
    }

    public function delete(Point $point)
    {
        $point->delete();
        return response()->json(null, 204);
    }
}
