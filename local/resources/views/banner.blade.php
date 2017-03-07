<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 04/03/2017
 * Time: 11:21
 */
?>
<section class="banner">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            @foreach($banner as $row)
            <div id="myCarousel" class="item">
                <img src="{{url('banner/'.$row->image)}}" alt="">
                <div class="carousel-caption">
                    {{$row->keterangan}}
                </div>
            </div>
                @endforeach
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>
