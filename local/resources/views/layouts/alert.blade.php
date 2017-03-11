<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 30/01/2017
 * Time: 14:50
 */
?>
{{--ALert--}}
@if (session('error'))
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h4><i class="icon fa fa-ban"></i> Peringatan!</h4>
        {!! session('error') !!}
    </div>
@endif
{{--End Alert--}}

{{--ALert--}}
@if (session('success'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h4><i class="icon fa fa-check"></i> Peringatan!</h4>
        {!! session('success') !!}
    </div>
@endif
{{--End Alert--}}

{{--ALert--}}
@if (session('info'))
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h4><i class="icon fa fa-info"></i> Peringatan!</h4>
        {!! session('info') !!}
    </div>
@endif
{{--End Alert--}}

