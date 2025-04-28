@extends('pages.TradeSubsystem.layout', 
[
    'title' => 'Direct Messages',
    'classes' => 'h-100',
    'html_class' => '',
    'description' => '',
	'poster' => ''
])
 
@section('main')

    @parent


    @section('styles')
        @parent
        <link rel="stylesheet" href="{{ asset('assets/css/TradeSubsystem/messages.css') }}"> 
    @endsection  
   
  
    @section('content') 

    @php
		$conversationDetails = array(
			'avatar'=>'',
			'role'=>'',
		);
	@endphp
	@if($conversationData)
		@foreach($conversationData as $data)

			@include('pages.TradeSubsystem.modals.message-options') 

		@endforeach 
	@else 

		

	@endif

    <div class="wrapper">

        <div class="sidebar">
            @include('pages.TradeSubsystem.common.sidebar') 
        </div>
        <div class="main">

            <div class="shade"></div>
            
            @include('pages.TradeSubsystem.common.header') 

            <main class="main-content pt-lg-5 pt-3">
              <div class="px-lg-5">

              		<div class="row mx-0 mx-lg">
              			<div class="col-lg-4 px-0 px-lg">
              				
              				<div class="horizontal-scroll market-scroll hide-scroll">
			              	<div class="pl-3 pl-lg-0 pr-3 pl-lg-0 d-flex d-lg-block">
							<?php $k = 0; ?>
							@if(count($conversations) > 0)
								@foreach($conversations as $conversation)
									@if(!Auth::user()->blockedUsers->contains('blocked_user_id', $conversation['userId']) && !Auth::user()->blockedByUsers->contains('blocked_by', $conversation['userId']))
										<?php $k++; ?>

										@php 

										if(!$currentConversation){

										echo '<script> window.location.replace("/app/messages/'.$conversation['id'].'")</script>';

										} 

										@endphp

										<div id="conversation-{{$conversation['id']}}" class="contact @if(isset($currentConversation) && $conversation['id'] == $currentConversation) active @endif mb-3 pr-3 pr-lg-0">
											<span class="contact-status @if($conversation['online']) online @endif">@if($conversation['online']) Just Now @else {{$conversation['active_ago']}} @endif </span>
											<a href="/app/messages/{{$conversation['id']}}" class="d-flex">
												<div class="align-self-center">
													<img src="{{$conversation['avatar']}}" alt="" />
												</div>
												<div class="align-self-center">
													<div class="meta">
														<p class="name mb-0 font-weight-bold lead"><i class="fad fa-circle mr-1 small text-success"></i>{{$conversation['username']}}</p>
														<p class="preview mb-0">@if($conversation['message']) {{$conversation['message']}} @else -- start converstation -- @endif </p>
													</div> 
												</div>
											</a>
										</div> 

									@endif
								@endforeach
							@endif 

							@if($k == 0) 
							 
								<div class="contact active mb-3 pr-3 pr-lg-0">
									<span class="contact-status online">Always Online </span>
									<a class="d-flex">
										<div class="align-self-center">
											<img src="{{ asset('assets/images/favicon.png') }}" alt="" />
										</div>
										<div class="align-self-center">
											<div class="meta">
												<p class="name mb-0 font-weight-bold lead"><i class="fad fa-circle mr-1 small text-success"></i>Niffler</p>
												<p class="preview mb-0"> Hey there, Guess what? You can now send direct messages</p>
											</div> 
										</div>
									</a>
								</div> 

							@endif
						</div>
						</div>

					

              			</div>
              			<div class="col-lg-8 d-flex px-0 px-lg">
              				 
              				<div class="px-3 px-lg-0 d-flex w-100 h-100">
              				<div class="card card-messages w-100">
              					<div class="card-body pb-0">
              						
              					<div class="contact-profile d-flex pb-3">
									
									@if($conversationData)
										@foreach($conversationData as $data)

											
											<?php $conversationDetails = $data; ?>
											<a target="_blank" href="/{{$data['handle']}}">
												<img src="{{$data['avatar']}}" alt="" />
											</a>
											<a class="align-self-center" target="_blank" href="/{{$data['handle']}}">  
											<h5 class="mb-0 font-weight-bold">{{$data['username']}}</h5>
											</a>
											<div class="ml-auto align-self-center pr-3">

											  <a class="" data-toggle="modal" data-target="#messagesModal">
											    <i class="fa fa-cog fa-fw" aria-hidden="true"></i>
											  </a>
										 
											</div> 
										@endforeach 
									@else 

										<img src="{{ asset('assets/images/favicon.png') }}" alt="" />
											
										<div class="align-self-center">  
											<h5 class="mb-0 font-weight-bold">{{ env('APP_NAME') }}</h5>

											</div>
										
									@endif
								</div>

              						<script>
										var myAvatar = "{{ $commonUserData['avatar'] }}";
										var otherAvatar = "{{$conversationDetails['avatar']}}";
										var myRole = "{{$conversationDetails['role']}}";
										var oldestMessageId = null;

										@php
										if(!$currentConversation) $currentConversation = 0;
										@endphp 

										var currentConversationId = {{$currentConversation}};
									
									</script>

									<div class="messages py-3">
										<ul class="pl-0">
											@if(array_key_exists('data', $conversationMessages) && count($conversationMessages['data']) > 0)
												@if($conversationMessages['hasMore'])
													<a id="load-older-messages" style="display: block;" class="mb-3 text-center">Load older messages <i class="ml-2 fal fa-arrow-down"></i></a>
												@endif
												@foreach($conversationMessages['data'] as $message)
													@if ($loop->first)
														<script>
															var oldestMessageId = {{$message['id']}};
														</script>
													@endif
													@if($message['author'] == $conversationDetails['role'])
														<li class="sent d-flex">

															<p class="ml-auto">{{$message['message']}}</p>
															<div class="pl-2">
															<img src="{{ $commonUserData['avatar'] }}" alt="" />
															</div>
															
														</li>
													@else  
														<li class="replies d-flex">
															
															<div class="pr-2">
																<img src="{{$conversationDetails['avatar']}}" alt="" />
															</div>
															<p class="">{{$message['message']}}</p>
															
														</li>						
													@endif
												@endforeach
											@endif

											@if($k == 0) 

											<li class="replies d-flex">

												<div class="pr-2">
													<img src="{{ asset('assets/images/favicon.png') }}" alt="" />
												</div>
												<p>Hey there, <br /><br /> Guess what? You can now send direct messages to fellow traders on {{ env('APP_NAME') }}. Get started by heading over to your profile and clicking the "Message" button. </p>
											</li>	

											<li class="replies d-flex">
												<div class="pr-2">
													<img src="{{ asset('assets/images/favicon.png') }}" alt="" />
												</div>
												<p>Ps. This message will disappear once your first chat happens.</p>
											</li>	

											@endif

										</ul>

										


										
									</div>

									@if($k > 0) 

									<div class="message-input pb-4">
										<div class="wrap">
											<form id="chat-form" method="post" action="">
												@csrf

												<input type="submit" style="display: none;" /> 
												<input type="hidden" name="conversation_id" value="{{$currentConversation}}"/>
												<input type="hidden" name="type" value="{{$conversationDetails['role']}}"/>
												<textarea class="form-control form-control-lg" name="message" placeholder="Write your message..."></textarea>
												<button class="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
												 
											</form>
										</div>
									</div>

									@else

									<div class="message-input pb-4">
										<div class="wrap">
											<form id="chat-form" method="post" action="">
												@csrf


												<input type="hidden" name="conversation_id" value="{{$currentConversation}}"/>
												<input type="hidden" name="type" value="{{$conversationDetails['role']}}"/>
												<textarea disabled class="form-control form-control-lg" name="message" placeholder=""></textarea>
												<button class="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
												  
											</form>
										</div>
									</div>

									@endif



              					</div>
              				</div>
              				</div> 


              			</div>
              		</div> 


                 

              </div>  
            </main>
        </div>

    </div> 




        
    @endsection

    @section('body-scripts')
        @parent
        <script src="{{ asset('assets/js/TradeSubsystem/messages.js') }}"></script>
    @endsection    

    

@endsection