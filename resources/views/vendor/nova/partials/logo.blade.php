<div style=" display: flex;
  align-items: center;
  justify-content: center;width:100%;">
    @if( auth()->user()->instituciones()->count()>0 )
        <img src="/{{auth()->user()->instituciones->first()->logo}}" style="width:50px;"><br>

    @endif
</div>
