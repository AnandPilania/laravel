@foreach ($peerExchanges as $index => $exchangeDetail)
    <div class="col-md-6">
        <div id="gridId{{$exchangeDetail['eId']}}" data-homeuniv="{{str_replace(array('(',')'),array('',''),strtolower($exchangeDetail['homeUniversity']))}}" data-hostuniv="{{str_replace(array('(',')'),array('',''),strtolower($exchangeDetail['hostUniversity']))}}" data-going="{{str_replace(array('(',')'),array('',''),strtolower($exchangeDetail['hostCountry']))}}" data-student="{{str_replace(array('(',')'),array('',''),strtolower($exchangeDetail['exchangeTerm']))}}" data-name="{{str_replace(array('(',')'),array('',''),strtolower($exchangeDetail['fname'] . ' ' . $exchangeDetail['lname']))}}">
            <div class="peers-area">
                <div class="pro-left">
                    <div class="pro-img user-img-broder">
                        @if ($exchangeDetail['avatar'] != '')
                            @if ((strpos($exchangeDetail['avatar'],'http://') !== false || strpos($exchangeDetail['avatar'],'https://') !== false))
                                <?php
                                    $imgSrc = str_replace('=normal', '=large', $exchangeDetail['avatar']);
                                ?>
                                <img src="{{ str_replace('=normal','=large&width=200&height=200',$exchangeDetail['avatar']) }}" class="profileImg">
                            @else
                                <img src="{{ asset('/img/memberImages/')}}/{{ $exchangeDetail['avatar'] }}"  class="profileImg">
                            @endif
                        @else
                            <img src="{{ asset('/img/Flying_profile.png') }}">
                        @endif
                    </div>
                </div>
                <div>
                    <h2>{{$exchangeDetail['fname']}} {{$exchangeDetail['lname']}}</h2>
                    <h4>{{$exchangeDetail['homeCountry']}}</h4>
                    <h4>{{$exchangeDetail['homeUniversity']}}</h4>
                    <div class="user-info-area">
                        <ul>
                            <li><u>{!! trans('community.going_overseas') !!}</u></li>
                            <li>{!! trans('community.city_country') !!}: {{$exchangeDetail['hostCountry']}}</li>
                            <li>{!! trans('community.host_institution') !!}: {{$exchangeDetail['hostUniversity']}}</li>
                            @if ($exchangeDetail['term_from'] && $exchangeDetail['term_to'])
                                <li>{!! trans('community.school_term') !!}: {{ Carbon\Carbon::parse($exchangeDetail['term_from'])->format('M Y') }} {!! trans('community.to') !!} {{ Carbon\Carbon::parse($exchangeDetail['term_to'])->format('M Y') }}</li>
                            @else
                                <li>{!! trans('community.school_term') !!}: {{$exchangeDetail['exchangeTerm']}}</li>
                            @endif
                        </ul>
                        @if (Auth::guest())
                            <p class="pro-button"><a href="javascript:void(0);" onclick="showError('{!! trans('community.please_login') !!}', 10000);$('html, body').animate({scrollTop : 0}, 800);">{!! trans('community.start_chat') !!}</a></p>
                        @elseif ($userData->exchange == NULL)
                            <p class="pro-button"><a href="javascript:void(0);" onclick="showError('{!! trans('community.please_update') !!}', 10000);$('html, body').animate({scrollTop : 0}, 800);">{!! trans('community.start_chat') !!}</a></p>
                        @elseif (Auth::user()->id == $exchangeDetail['userId'])
                            <p class="pro-button"><a href="javascript:void(0);" onclick="return loggedinUser();">{!! trans('community.chat') !!}</a></p>
                        @else
                            <p class="pro-button"><a href="javascript:void(0);" onclick="openModalPop(this);" data-type="1" data-userid="{{Auth::user()->id}}" data-toid="{{$exchangeDetail['userId']}}" data-personalizedMsg="{{ str_replace('{name}', Auth::user()->fname.' '.Auth::user()->lname, str_replace('{exchange_name}', $exchangeDetail['fname'].' '.$exchangeDetail['lname'], trans('community.peer_start_chat'))) }}">{!! trans('community.start_chat') !!}</a></p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($index % 2 == 1)
        <div class="clearfix"></div>
    @endif
@endforeach
