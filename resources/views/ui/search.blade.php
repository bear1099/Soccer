@extends('common.layout')
@section('addTitle')
<title>Search World Cup Database</title>
@stop
@section('addMeta')
<meta name="csrf-token" content="{{csrf_token()}}">
@stop
@include('common.header')
@section('content')

<style>
    #search_form_area {
        padding: 0.5em 1em;
        margin: 2em 0;
        background: #f0f7ff;
        border: dashed 2px #5b8bd0;
    }
</style>

<div class="container">
    <div class="title">Search World Cup Database</div>

    <form action="./search_results" method="POST">
        @CSRF


        <div id="search_form_area">
            <div class="title">Search Form</div>
            <div class="form-group">

                <label for="Tournament">Tournament</label>
                <select class="form-control" id="tournament" name="tournament" v-model="tournament_id" @change = "updateTeams();tournamentChange();">
                    <option value="0" selected></option>
                    <?php foreach ($tournaments as $v) { ?>
                        <option value=<?php echo $v->id; ?>><?php echo $v->name; ?></option>
                    <?php } ?>
                </select>
            
            
            
                <label for="Knockout">Round</label>
                <select class="form-control" id="knockout" name="knockout" v-model="knockout_id" @change = "updateTeams(); knockoutChange(); updateGroups(); ">
                        <option value="0" selected></option>
                        <option value="1">Knockout</option>
                        <option value="2">Group</option>
                </select>

                <div :style="{display: isDisplay}">        
                <label for="Group">Group</label>
                <select class="form-control" id="group" name="group" v-model="group_id">
                    <option value="0" selected></option>
                    <option v-for = "val in groups" :value="val.id">@{{val.name}}</option>
                </select>
                </div>


                <div :style="{display: isDisplay3}">
                <label for ="Team">Team</label>
                <select class="form-control" id="team" name="team" v-model="team_id" @change = "outcomeChange();">
                            <option value="0" selected></option> 
                            <option v-for = "val in teams" :value="val.id">@{{val.name}}</option>
                </select>
                </div>

                <div :style="{display: isDisplay2}">
                <label for = "Outcome">Outcome</label>
                <select class="form-control" id="outcome" name="outcome" v-model="outcome">
                        <option value="0" selected></option>
                        <option value="勝利">勝利</option>
                        <option value="敗北">敗北</option>
                        <option value="引き分け">引き分け</option>
                </select>
                </div>

                
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            
        </div>

    </form>
</div>
<script src="{{ mix('js/search.js') }}">
</script>

@stop
@include('common.footer')
