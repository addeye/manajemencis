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
        {{ session('error') }}
    </div>
@endif
{{--End Alert--}}

{{--ALert--}}
@if (session('success'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ session('success') }}
    </div>
@endif
{{--End Alert--}}

{{--ALert--}}
@if (session('info'))
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ session('info') }}
    </div>
@endif
{{--End Alert--}}

