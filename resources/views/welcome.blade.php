<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="//fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">Laravel 5</div>

                <div class="height10"></div>
            		<div class="form-group col-md-12">
            		<td>
            			<li><a href="{{ URL::route('ticket::picStatusRespond',['id' => $data->id,'pic_status'=>'Respond' ]) }}">Respond</a></li>
            			<li><a href="{{ URL::route('ticket::picStatusRecover',['id' => $data->id,'pic_status'=>'Recover' ]) }}">Recover</a></li>
            			<li><a href="{{ URL::route('ticket::picStatusResolve',['id' => $data->id,'pic_status'=>'Resolve' ]) }}">Resolve</a></li>
            			<li><a href="{{ URL::route('ticket::picStatusClose',['id' => $data->id,'pic_status'=>'Close' ]) }}">Close</a></li>
            		</td>
            	</div>
              
            </div>
        </div>
    </body>
</html>
