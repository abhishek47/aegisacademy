@extends('layouts.app')



@section('content')



	<div class="bg-grey-lightest pb-60 pt-45">
		<div class="container mx-auto">

			 <div class="mb-40">
	              <h2 class="text-4xl text-left text-brand mb-8 tracking-wide leading-normal capitalize font-semibold">
	                Wiki Articles &ndash; Learn with reading
	            </h2>
	        </div>

			<div class="flex">
				<div class="w-1/4 p-3 pl-0 pt-0">
					<div class="bg-white rounded shadow">
						<div class="bg-brand">
							<h4 class="text-white font-semibold pt-4 pb-4 pl-4 text-xl tracking-wide">Topics</h4>
						</div>
						<hr class="border m-0 p-0">
						<ul class="list-reset flex flex-col">

							<li class="bg-grey-lighter p-4 hover:bg-grey-lighter cursor-pointer border-x-0 border-t-0 border-b border-grey-light" >
								<a class="no-underline text-grey-darker text-lg font-semibold tracking-wide" href="">
								 <i class="fa fa-circle text-grey-darker text-xs mr-2"></i> All
								</a>
							</li>

							<li class="p-4 hover:bg-grey-lighter cursor-pointer border-x-0 border-t-0 border-b border-grey-light" >
								<a class="no-underline text-grey-darker text-lg font-semibold tracking-wide" href="">
								 <i class="fa fa-circle text-brand text-xs mr-2"></i> Topical
								</a>
							</li>

							<li class="p-4 hover:bg-grey-lighter cursor-pointer border-x-0 border-t-0 border-b border-grey-light">
								<a class="no-underline text-grey-darker text-lg font-semibold tracking-wide" href="">
									<i class="fa fa-circle text-red text-xs mr-2"></i> Problematic</a>
							</li>

							<li class="p-4 hover:bg-grey-lighter cursor-pointer border-x-0 border-t-0 border-b border-grey-light">
								<a class="no-underline text-grey-darker text-lg font-semibold tracking-wide" href="">
									<i class="fa fa-circle text-green text-xs mr-2"></i> Knowledge</a>
							</li>

							<li class="p-4 hover:bg-grey-lighter cursor-pointer">
								<a class="no-underline text-grey-darker text-lg font-semibold tracking-wide" href="">
									<i class="fa fa-circle text-blue text-xs mr-2"></i> News</a>
							</li>

						</ul>

					</div>
				</div>
				<div class="w-3/4 p-3 pt-0">
					<div class="flex flex-col">
						<div class="flex">
							 <a href="#" class="no-underline text-black w-1/2 pr-6 mb-8">
				                <div class="rounded shadow bg-white p-6">
				                    <span class="rounded bg-brand p-1 px-4 text-white tracking-wide text-sm">Topical</span>
				                    <h3 class="w-full text-2xl font-normal tracking-normal leading-normal mt-4 mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit</h3>
				                    <div class="flex flex-end">
				                     <span class="flex-1 text-grey-darker"><i class="fa fa-star text-yellow"></i> <i class="fa fa-star text-yellow"></i> <i class="fa fa-star text-yellow"></i>  </span>
				                     <span class="text-grey-darker"><i class="fa fa-clock"></i> 23rd June 2018</span>
				                    </div>
				                </div>
				            </a>

				             <a href="#" class="no-underline text-black w-1/2 pr-6 mb-8">
				                <div class="rounded shadow bg-white p-6">
				                   <span class="rounded bg-orange p-1 px-4 text-white tracking-wide text-sm">Problematic</span>
				                    <h3 class="w-full text-2xl font-normal tracking-normal leading-normal mt-4 mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit</h3>
				                    <div class="flex flex-end">
				                     <span class="flex-1 text-grey-darker"><i class="fa fa-star text-yellow"></i> <i class="fa fa-star text-yellow"></i> <i class="fa fa-star text-yellow"></i> <i class="fa fa-star text-yellow"></i> </span>
				                     <span class="text-grey-darker"><i class="fa fa-clock"></i> 23rd June 2018</span>
				                    </div>
				                </div>
				            </a>
						</div>

						<div class="flex">
							<a href="#" class="no-underline text-black w-1/2 pr-6 mb-8">
				                <div class="rounded shadow bg-white p-6">
				                   <span class="rounded bg-green p-1 px-4 text-white tracking-wide text-sm">Knowledge</span>
				                    <h3 class="w-full text-2xl font-normal tracking-normal leading-normal mt-4 mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit</h3>
				                    <div class="flex flex-end">
				                     <span class="flex-1 text-grey-darker"><i class="fa fa-star text-yellow"></i> <i class="fa fa-star text-yellow"></i> <i class="fa fa-star-half text-yellow"></i> </span>
				                     <span class="text-grey-darker"><i class="fa fa-clock"></i> 23rd June 2018</span>
				                    </div>
				                </div>
				            </a>

				            <a href="#" class="no-underline text-black w-1/2 pr-6 mb-8">
				                <div class="rounded shadow bg-white p-6">
				                    <span class="rounded bg-brand p-1 px-4 text-white tracking-wide text-sm">Topical</span>
				                    <h3 class="w-full text-2xl font-normal tracking-normal leading-normal mt-4 mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit</h3>
				                    <div class="flex flex-end">
				                     <span class="flex-1 text-grey-darker"><i class="fa fa-star text-yellow"></i> <i class="fa fa-star text-yellow"></i></span>
				                     <span class="text-grey-darker"><i class="fa fa-clock"></i> 23rd June 2018</span>
				                    </div>
				                </div>
				            </a>
						</div>

						<div class="flex">
							 <a href="#" class="no-underline text-black w-1/2 pr-6 mb-8">
				                <div class="rounded shadow bg-white p-6">
				                    <span class="rounded bg-brand p-1 px-4 text-white tracking-wide text-sm">Topical</span>
				                    <h3 class="w-full text-2xl font-normal tracking-normal leading-normal mt-4 mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit</h3>
				                    <div class="flex flex-end">
				                     <span class="flex-1 text-grey-darker"><i class="fa fa-star text-yellow"></i> <i class="fa fa-star text-yellow"></i> <i class="fa fa-star text-yellow"></i>  </span>
				                     <span class="text-grey-darker"><i class="fa fa-clock"></i> 23rd June 2018</span>
				                    </div>
				                </div>
				            </a>

				             <a href="#" class="no-underline text-black w-1/2 pr-6 mb-8">
				                <div class="rounded shadow bg-white p-6">
				                   <span class="rounded bg-orange p-1 px-4 text-white tracking-wide text-sm">Problematic</span>
				                    <h3 class="w-full text-2xl font-normal tracking-normal leading-normal mt-4 mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit</h3>
				                    <div class="flex flex-end">
				                     <span class="flex-1 text-grey-darker"><i class="fa fa-star text-yellow"></i> <i class="fa fa-star text-yellow"></i> <i class="fa fa-star text-yellow"></i> <i class="fa fa-star text-yellow"></i> </span>
				                     <span class="text-grey-darker"><i class="fa fa-clock"></i> 23rd June 2018</span>
				                    </div>
				                </div>
				            </a>
						</div>

						<div class="flex">
							<a href="#" class="no-underline text-black w-1/2 pr-6 mb-8">
				                <div class="rounded shadow bg-white p-6">
				                   <span class="rounded bg-green p-1 px-4 text-white tracking-wide text-sm">Knowledge</span>
				                    <h3 class="w-full text-2xl font-normal tracking-normal leading-normal mt-4 mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit</h3>
				                    <div class="flex flex-end">
				                     <span class="flex-1 text-grey-darker"><i class="fa fa-star text-yellow"></i> <i class="fa fa-star text-yellow"></i> <i class="fa fa-star-half text-yellow"></i> </span>
				                     <span class="text-grey-darker"><i class="fa fa-clock"></i> 23rd June 2018</span>
				                    </div>
				                </div>
				            </a>

				            <a href="#" class="no-underline text-black w-1/2 pr-6 mb-8">
				                <div class="rounded shadow bg-white p-6">
				                    <span class="rounded bg-brand p-1 px-4 text-white tracking-wide text-sm">Topical</span>
				                    <h3 class="w-full text-2xl font-normal tracking-normal leading-normal mt-4 mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit</h3>
				                    <div class="flex flex-end">
				                     <span class="flex-1 text-grey-darker"><i class="fa fa-star text-yellow"></i> <i class="fa fa-star text-yellow"></i></span>
				                     <span class="text-grey-darker"><i class="fa fa-clock"></i> 23rd June 2018</span>
				                    </div>
				                </div>
				            </a>
						</div>


					</div>
				</div>
			</div>
		</div>
	</div>

@endsection