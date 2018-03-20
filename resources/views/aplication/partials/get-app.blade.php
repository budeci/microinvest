
@if($app->applicationStateCode == '0')
    <?php 
        $status = 'warning'; 
        $ico    = '<i class="text-warning fa fa-spinner fa-pulse fa-fw" aria-hidden="true"></i>';
    ?>
@elseif($app->applicationStateCode == '1')
    <?php 
        $status = 'success'; 
        $ico    = '<i class="text-success fa fa-check fa-fw" aria-hidden="true"></i>';
    ?>
@else
    <?php 
        $status = 'danger';
        $ico    = '<i class="text-danger fa fa-ban fa-fw" aria-hidden="true"></i>'; 
    ?>
@endif
<?php $appFiles = array(); ?>
@if(!empty((array)$app->applicationFileSet))
    @if(count($app->applicationFileSet->applicationFile) == 1)
        <?php $appFiles = array($app->applicationFileSet->applicationFile); ?>
    @else
        <?php $appFiles = $app->applicationFileSet->applicationFile; ?>
    @endif
@endif

    <td>{!!$ico!!} <input class="" type="hidden" value="{{$app->id}}"></td>
    <td>{{$app->date}}</td>
    <td>{{$app->clientName}}</td>
    <td>{{$app->loanAmount}} {{$app->loanCurrency}}</td>
    <td><p class="showmore comment" data-show-lg="20" data-moretext=">>>" data-lesstext="<<<">{{$app->loanPurpose}}</p></td>
    <td><p class="showmore comment" data-show-lg="20" data-moretext=">>>" data-lesstext="<<<">{{$app->comment}}</p></td>
    <td><span class="btn btn-{{$status}} btn-block btn-sm">{{$app->applicationState}}</span></td>
    <td>{{$app->dealerName}}</td>
    <td>
        @foreach ($appFiles as $file)
            <a href="{{ route('get_app_file', ['name' => $file->name, 'id' => $app->id]) }}" title="{{$file->name}}" class="showmore file" data-show-lg="10"  data-moretext="" data-lesstext="">{{$file->name}}</a><br>
        @endforeach
    </td>
