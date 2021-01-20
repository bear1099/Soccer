<?php

namespace App\Http\Controllers;

use DB;
use Log;
use Illuminate\Http\Request;

class WCController extends Controller
{
    public function search()
    {
        DB::enableQueryLog();

        $options = [];
        $tournament = DB::table('wc_tournament')
            ->select('id', 'name')
            ->get();
        $group = DB::table('wc_group')
            ->select('id','name')
            ->get();

        $team = DB::table('wc_team')
            ->select('id','name')
            ->get();

        return view('ui/search', [
            'tournaments' => $tournament,
            'group' => $group,
            'team' =>$team
        ]);
    }

    public function searchResults()
    {
        DB::enableQueryLog();
        $tournament_id = request('tournament');
        $round = request('knockout');
        $group = request('group');
        $team = request('team');
        $outcome = request('outcome');
        $status;
        if($round==0&&$round==0&&$team==0){
                $status = "トーナメントのみ入力されました";
                $result = DB::table('wc_tournament')
                ->join('wc_round','wc_tournament.id','=','wc_round.tournament_id')
                ->join('wc_match','wc_round.id','=','wc_match.round_id')
                ->join('wc_group','wc_match.group_id','=','wc_group.id')
                ->join('wc_result','wc_match.id','=','wc_result.match_id')
                ->join('wc_team as wc_team0','wc_result.team_id0','=','wc_team0.id')
                ->join('wc_team as wc_team1','wc_result.team_id1','=','wc_team1.id')
                ->select('wc_tournament.name AS tournament_name','wc_round.name AS round_name','wc_group.name AS group_name','wc_match.start_date AS date','wc_team0.name AS team0_name','wc_result.outcome AS outcome','wc_team1.name AS team1_name')
                ->where('wc_tournament.id','=',$tournament_id)
                ->get();
        }elseif($group==0&&$team==0){
            $status = "トーナメントとラウンドのみ入力されました";
            $result = DB::table('wc_tournament')
                ->join('wc_round','wc_tournament.id','=','wc_round.tournament_id')
                ->join('wc_match','wc_round.id','=','wc_match.round_id')
                ->join('wc_group','wc_match.group_id','=','wc_group.id')
                ->join('wc_result','wc_match.id','=','wc_result.match_id')
                ->join('wc_team as wc_team0','wc_result.team_id0','=','wc_team0.id')
                ->join('wc_team as wc_team1','wc_result.team_id1','=','wc_team1.id')
                ->select('wc_tournament.name AS tournament_name','wc_round.name AS round_name','wc_group.name AS group_name','wc_match.start_date AS date','wc_team0.name AS team0_name','wc_result.outcome AS outcome','wc_team1.name AS team1_name')
                ->where('wc_tournament.id','=',$tournament_id)
                ->where('wc_round.knockout','=',$round)
                ->get();
        }elseif($team==0){
            $status = "チーム以外入力されています";
            $result = DB::table('wc_tournament')
                ->join('wc_round','wc_tournament.id','=','wc_round.tournament_id')
                ->join('wc_match','wc_round.id','=','wc_match.round_id')
                ->join('wc_group','wc_match.group_id','=','wc_group.id')
                ->join('wc_result','wc_match.id','=','wc_result.match_id')
                ->join('wc_team as wc_team0','wc_result.team_id0','=','wc_team0.id')
                ->join('wc_team as wc_team1','wc_result.team_id1','=','wc_team1.id')
                ->select('wc_tournament.name AS tournament_name','wc_round.name AS round_name','wc_group.name AS group_name','wc_match.start_date AS date','wc_team0.name AS team0_name','wc_result.outcome AS outcome','wc_team1.name AS team1_name')
                ->where('wc_tournament.id','=',$tournament_id)
                ->where('wc_round.knockout','=',$round)
                ->where('wc_group.id','=',$group)
                ->get();
            }elseif($outcome==0){
                $status = "結果以外入力されています";
            $result = DB::table('wc_tournament')
                ->join('wc_round','wc_tournament.id','=','wc_round.tournament_id')
                ->join('wc_match','wc_round.id','=','wc_match.round_id')
                ->join('wc_group','wc_match.group_id','=','wc_group.id')
                ->join('wc_result','wc_match.id','=','wc_result.match_id')
                ->join('wc_team as wc_team0','wc_result.team_id0','=','wc_team0.id')
                ->join('wc_team as wc_team1','wc_result.team_id1','=','wc_team1.id')
                ->select('wc_tournament.name AS tournament_name','wc_round.name AS round_name','wc_group.name AS group_name','wc_match.start_date AS date','wc_team0.name AS team0_name','wc_result.outcome AS outcome','wc_team1.name AS team1_name')
                ->where('wc_tournament.id','=',$tournament_id)
                ->where('wc_round.knockout','=',$round)
                ->where('wc_group.id','=',$group)
                ->where('wc_team0.id','=',$team)
                ->orwhere('wc_team1.id','=',$team)
                ->get();
            }elseif($round==0&&$outcome==0){
                $status = "ラウンドと結果以外入力されています";
            $result = DB::table('wc_tournament')
                ->join('wc_round','wc_tournament.id','=','wc_round.tournament_id')
                ->join('wc_match','wc_round.id','=','wc_match.round_id')
                ->join('wc_group','wc_match.group_id','=','wc_group.id')
                ->join('wc_result','wc_match.id','=','wc_result.match_id')
                ->join('wc_team as wc_team0','wc_result.team_id0','=','wc_team0.id')
                ->join('wc_team as wc_team1','wc_result.team_id1','=','wc_team1.id')
                ->select('wc_tournament.name AS tournament_name','wc_round.name AS round_name','wc_group.name AS group_name','wc_match.start_date AS date','wc_team0.name AS team0_name','wc_result.outcome AS outcome','wc_team1.name AS team1_name')
                ->where('wc_tournament.id','=',$tournament_id)
                ->where('wc_team0.id','=',$team)
                ->orwhere('wc_team1.id','=',$team)
                ->get();
            }elseif($round==0){
                $status = "ラウンド以外入力されています";
            $result = DB::table('wc_tournament')
                ->join('wc_round','wc_tournament.id','=','wc_round.tournament_id')
                ->join('wc_match','wc_round.id','=','wc_match.round_id')
                ->join('wc_group','wc_match.group_id','=','wc_group.id')
                ->join('wc_result','wc_match.id','=','wc_result.match_id')
                ->join('wc_team as wc_team0','wc_result.team_id0','=','wc_team0.id')
                ->join('wc_team as wc_team1','wc_result.team_id1','=','wc_team1.id')
                ->select('wc_tournament.name AS tournament_name','wc_round.name AS round_name','wc_group.name AS group_name','wc_match.start_date AS date','wc_team0.name AS team0_name','wc_result.outcome AS outcome','wc_team1.name AS team1_name')
                ->where('wc_tournament.id','=',$tournament_id)
                ->where('wc_team0.id','=',$team)
                ->where('wc_result.outcome','=',$outcome)
                ->get();
             }else{
                 $status = "else";
            $result = DB::table('wc_tournament')
                ->join('wc_round','wc_tournament.id','=','wc_round.tournament_id')
                ->join('wc_match','wc_round.id','=','wc_match.round_id')
                ->join('wc_group','wc_match.group_id','=','wc_group.id')
                ->join('wc_result','wc_match.id','=','wc_result.match_id')
                ->join('wc_team as wc_team0','wc_result.team_id0','=','wc_team0.id')
                ->join('wc_team as wc_team1','wc_result.team_id1','=','wc_team1.id')
                ->select('wc_tournament.name AS tournament_name','wc_round.name AS round_name','wc_group.name AS group_name','wc_match.start_date AS date','wc_team0.name AS team0_name','wc_result.outcome AS outcome','wc_team1.name AS team1_name')
                ->where('wc_tournament.id','=',$tournament_id)
                ->where('wc_round.knockout','=',$round)
                ->where('wc_group.id','=',$group)
                ->where('wc_team0.name','=',$team)
                ->orwhere('wc_team1.name','=',$team)
                ->where('wc_result','=',$outcome)
                ->get();
             }
	return view('ui/search_result',[
        'result' => $result,
        'id' => $tournament_id,
        'status' => $status,
    ]);
    }

    public function updateTeams($t_id,$k_id){
        //大会に参加したチームのidとnameを取得。
        $param = $k_id;
        if($param == 0){
        $result = DB::table('wc_tournament')
        ->join('wc_round','wc_tournament.id','=','wc_round.tournament_id')
        ->join('wc_match','wc_round.id','=','wc_match.round_id')
        ->join('wc_group','wc_match.group_id','=','wc_group.id')
        ->join('wc_result','wc_match.id','=','wc_result.match_id')
        ->join('wc_team as wc_team0','wc_result.team_id0','=','wc_team0.id')
        ->join('wc_team as wc_team1','wc_result.team_id1','=','wc_team1.id')
        ->select('wc_team1.id AS id','wc_team1.name AS name')
        ->where('wc_tournament.id','=',$t_id)
        ->distinct()
        ->get();
        }else{
         $result = DB::table('wc_tournament')
        ->join('wc_round','wc_tournament.id','=','wc_round.tournament_id')
        ->join('wc_match','wc_round.id','=','wc_match.round_id')
        ->join('wc_group','wc_match.group_id','=','wc_group.id')
        ->join('wc_result','wc_match.id','=','wc_result.match_id')
        ->join('wc_team as wc_team0','wc_result.team_id0','=','wc_team0.id')
        ->join('wc_team as wc_team1','wc_result.team_id1','=','wc_team1.id')
        ->select('wc_team1.id AS id','wc_team1.name AS name')
        ->where('wc_tournament.id','=',$t_id)
        ->where('wc_round.knockout','=',$k_id)
        ->distinct()
        ->get();   
        }
        return json_encode($result);
    }

    public function updateGroups($t_id){
        $result = DB::table('wc_tournament')
        ->join('wc_round','wc_tournament.id','=','wc_round.tournament_id')
        ->join('wc_match','wc_round.id','=','wc_match.round_id')
        ->join('wc_group','wc_match.group_id','=','wc_group.id')
        ->select('wc_group.id AS id','wc_group.name AS name')
        ->where('wc_tournament.id','=',$t_id)
        ->where('wc_round.knockout','=','2')
        ->distinct()
        ->get();
        return json_encode($result);
    }
}
