@extends('web.layouts.app')

@section('content')
    <style>
        :root {
            --card-height: 40vw;
            --card-margin: 4vw;
            --card-top-offset: 1em;
            --numcards: 4;
            --outline-width: 0px;
        }

        #cards {
            padding-bottom: calc(var(--numcards) * var(--card-top-offset)); /* Make place at bottom, as items will slide to that position*/
            margin-bottom: var(--card-margin); /* Don't include the --card-margin in padding, as that will affect the scroll-timeline*/
        }

        #card_1 {
            --index: 1;
        }

        #card_2 {
            --index: 2;
        }

        #card_3 {
            --index: 3;
        }

        #card_4 {
            --index: 4;
        }

        .card {
            background: none;
            border: none;
            position: sticky;
            top: 0;
            padding-top: calc(var(--index) * var(--card-top-offset));
        }

        @supports (animation-timeline: works) {

            @scroll-timeline cards-element-scrolls-in-body {
                source: selector(body);
                scroll-offsets:
                    /* Start when the start edge touches the top of the scrollport */
                    selector(#cards) start 1,
                        /* End when the start edge touches the start of the scrollport */
                    selector(#cards) start 0
            ;
                start: selector(#cards) start 1; /* Start when the start edge touches the top of the scrollport */
                end: selector(#cards) start 0; /* End when the start edge touches the start of the scrollport */
                time-range: 4s;
            }

            .card {
                --index0: calc(var(--index) - 1); /* 0-based index */
                --reverse-index: calc(var(--numcards) - var(--index0)); /* reverse index */
                --reverse-index0: calc(var(--reverse-index) - 1); /* 0-based reverse index */
            }

            .card__content {
                transform-origin: 50% 0%;
                will-change: transform;

                --duration: calc(var(--reverse-index0) * 1s);
                --delay: calc(var(--index0) * 1s);

                animation: var(--duration) linear scale var(--delay) forwards;
                animation-timeline: cards-element-scrolls-in-body;
            }

            @keyframes scale {
                to {
                    transform:
                        scale(calc(
                            1.1
                            -
                            calc(0.1 * var(--reverse-index))
                        ));
                }
            }
        }

        /** DEBUG **/

        #debug {
            position: fixed;
            top: 1em;
            left: 1em;
        }
        #debug::after {
            content: " Show Debug";
            margin-left: 1.5em;
            color: white;
            white-space: nowrap;
        }




        /** PAGE STYLING **/

        * { /* Poor Man's Reset */
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            color: red;
            text-align: center;
            font-size: calc(1em + 0.5vw);
        }




        #cards {
            list-style: none;
            outline: calc(var(--outline-width) * 10) solid blue;

            display: grid;
            grid-template-columns: 1fr;
            grid-template-rows: repeat(var(--numcards), var(--card-height));
            gap: var(--card-margin);
        }

        .card {
            outline: var(--outline-width) solid hotpink;
        }

        .card__content {
            box-shadow: 0 0.2em 1em rgba(0, 0, 0, 0.1), 0 1em 2em rgba(0, 0, 0, 0.1);
               background: #f5f2ee;
        ;
            border-radius: 1em;
            overflow: hidden;

            display: grid;
            grid-template-areas: "text img";
            grid-template-columns: 1fr 1fr;
            grid-template-rows: auto;

            align-items: stretch;
            outline: var(--outline-width) solid lime;
        }

        .card__content > div {
            grid-area: text;
            width: 80%;
            place-self: center;
            text-align: left;

            display: grid;
            gap: 1em;
            place-items: start;
        }

        .card__content > figure {
            grid-area: img;
            overflow: hidden;
            margin-bottom: auto;

        }

        .card__content > figure > img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        h1 {
            font-family: 'Karla', sans-serif;
            font-weight: 300;
            font-size: 3.5em;
        }

        h2 {
            font-family: 'Karla', sans-serif;
            font-weight: 300;
            font-size: 2.5em;
        }

        p {
            font-family: 'Karla', sans-serif;
            font-weight: 300;
            line-height: 1.42;
        }

        .btn {
            background: rgb(188 87 36);
            color: rgb(255 255 255);
            text-decoration: none;
            display: inline-block;
            padding: 0.5em;
            border-radius: 0.25em;
        }

        aside {
            width: 50vw;
            margin: 0 auto;
            text-align: left;
        }

        aside p {
            margin-bottom: 1em;
        }


    </style>

<div class="sub-container">
    <div class="sub-wrapper">
        <div class="sub-content" style="width: 97%">
            <ul id="cards">
                <li class="card" id="card_1">
                    <div class="card__content">

                        <div>
                            <h2>TPE-PME</h2>
                            <p >Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                            <p><a href="#top" class="btn btn--accent">Read more</a></p>
                        </div>
                        <figure class="img_action">
                            <img class="img_done" style="width:62%!important;" src="{{ asset('/img/44.png') }}"  alt="Image description">
                        </figure>
                    </div>
                </li>
                <li class="card" id="card_2">
                    <div class="card__content">
                        <div>
                            <h2>Agence</h2>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                            <p><a href="#top" class="btn btn--accent">Read more</a></p>
                        </div>
                        <figure class="img_action">
                                <img class="img_done" src="{{ asset('/img/22.png') }}" alt="Image description">
                        </figure>
                    </div>
                </li>
                <li class="card" id="card_3">
                    <div class="card__content">
                        <div>
                            <h2>Collectivités</h2>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                            <p><a href="#top" class="btn btn--accent">Read more</a></p>
                        </div>
                        <figure class="img_action " >
                            <img class="img_done"  src="{{ asset('/img/11.png') }}" alt="Image description">
                        </figure>
                    </div>
                </li>

            </ul>

        </div>
    </div>
</div>
@endsection
