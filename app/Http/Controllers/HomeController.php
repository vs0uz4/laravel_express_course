<?php

namespace MyBlog\Http\Controllers;

use Illuminate\Http\Request;

use MyBlog\Http\Requests;
use MyBlog\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts = [
            0 => [
                'author' => 'vS0uz4',
                'public_date' => 'September 24, 2014',
                'title' => 'Quisque diam dolor',
                'body_resume' => 'Quisque diam dolor, ultrices non ultrices sed, rutrum ac ante. Pellentesque eget cursus elit.',
                'body' => 'Quisque diam dolor, ultrices non ultrices sed, rutrum ac ante. Pellentesque eget cursus elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque rutrum ligula ut fermentum efficitur. Curabitur pharetra libero eget metus eleifend, eget consectetur felis malesuada. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Integer tincidunt tempus nulla, sed bibendum eros elementum in. Duis facilisis justo sed eros ultricies pulvinar. Suspendisse tempus felis sit amet maximus sodales. Fusce risus massa, rutrum non quam a, consectetur dapibus justo.'
            ],

            1 => [
                'author' => 'vS0uz4',
                'public_date' => 'September 18, 2014',
                'title' => 'Nam sagittis velit orci',
                'body_resume' => 'Nam sagittis velit orci, tempor sodales dolor dapibus quis. Vivamus sagittis lectus metus, ultrices ultrices orci finibus et.',
                'body' => 'Nam sagittis velit orci, tempor sodales dolor dapibus quis. Vivamus sagittis lectus metus, ultrices ultrices orci finibus et. Vestibulum ac ligula iaculis, suscipit lorem ac, finibus diam. Ut ut felis fermentum, tempus nisi sed, fringilla quam. Quisque imperdiet ligula non turpis scelerisque, id maximus justo commodo. Praesent sit amet lacus id mauris eleifend scelerisque in non turpis. Mauris vitae magna non dolor finibus mollis vel vel odio. Nam eleifend, eros ac tincidunt viverra, lacus leo lobortis arcu, a suscipit arcu purus sed eros. Nam eget feugiat purus, sed vehicula enim.'
            ],

            2 => [
                'author' => 'Admin',
                'public_date' => 'August 24, 2014',
                'title' => 'Ut rutrum leo vitae ornare tincidunt.',
                'body_resume' => 'Ut rutrum leo vitae ornare tincidunt. Maecenas tristique iaculis pellentesque.',
                'body' => 'Ut rutrum leo vitae ornare tincidunt. Maecenas tristique iaculis pellentesque. Nulla lectus leo, malesuada in vulputate sit amet, posuere eu arcu. Vivamus dignissim dolor ipsum, sed interdum massa tempus sit amet. Proin ut sem quis odio posuere hendrerit sed nec orci. Vestibulum eget tristique neque. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce vel tempus dolor. Etiam id purus turpis. Vivamus nec ex vel eros vulputate congue id et mi.'
            ],

            3 => [
                'author' => 'jSilva',
                'public_date' => 'July 8, 2014',
                'title' => 'Lorem ipsum dolor sit amet',
                'body_resume' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam justo libero, auctor sed metus malesuada, mollis elementum neque. Mauris leo eros, efficitur vitae vestibulum gravida, aliquet in dui. Nunc non ante laoreet, bibendum ex euismod, convallis libero. Suspendisse id turpis congue, viverra lectus quis, cursus ipsum. Nulla iaculis mi tortor, et fringilla libero porttitor eleifend. Donec tincidunt enim neque, ut tristique eros laoreet a. Donec quis dui sed tellus consectetur tempor. Maecenas vitae ex tortor. Etiam eros leo, sollicitudin quis iaculis sit amet, sagittis a dolor. Quisque nisi lectus, fringilla nec tincidunt et, placerat ut orci. In luctus diam at lectus maximus ullamcorper. Ut molestie arcu nisi, eget scelerisque metus vestibulum non.'
            ]
        ];

        return view('pages.home.index', compact('posts'));

    }

}
