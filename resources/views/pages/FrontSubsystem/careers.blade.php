@extends('pages.FrontSubsystem.layout', 
[
    'title' => 'We\'re Hiring | Niffler.co',
    'classes' => '',
    'html_class' => '',
    'description' => 'By joining Niffler.co, you’ll work at the cutting edge of digital currencies while playing an integral role in helping shape the future of how the world sees and adapts to cryptocurrencies.',
    'nofollow'=>true,
	'poster' => 'assets/images/niffler-og.jpg'
]) 

@section('main')

    @parent

    @section('content')

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <!-- Welcome Section -->
        <div class="welcome d-flex justify-content-center flex-column ">

            @include('pages.FrontSubsystem.common.header') 

             

            <!-- Inner Wrapper -->
            <div class="border-bottom pb-4 pb-sm-5 page-content">

            	<div class="page-content">  
            	<div class="landing-cta mb-4 mb-sm-5">  

                <div class="container">
                <div class="row justify-content-center">
                <div class="col-lg-8 mb-0 py-5"">
                      <h1 class="font-weight-bold text-white text-center text-lg-left">

                       We're Hiring 

                      </h1> 
                </div>
                </div>
                </div>
                
             	</div> 
             	</div> 

                <div class="inner-wrapper mt-auto mb-auto container">
                <div class="row justify-content-center">
                    <div class="col-11 col-sm-10 col-lg-8 text-left">

						<p>
						By joining Niffler.co, you’ll work at the cutting edge of digital currencies while playing an integral role in helping shape the future of how the world sees and adapts to cryptocurrencies. You will have the opportunity to join a growing team and startup in an exciting, fast-growing new market with tremendous potential to grow and scale, at a very early stage! 
						</p>

						<p>At Niffler.co, we constantly push ourselves to think differently by aiming to to be at the forefront of the cryptocurrency ecosystem... first by education and then so much more. 
						</p>

						<p>At Niffler.co we provide a  fun, dynamic work environment with competitive compensation, benefits, and opportunities to grow and learn from your peers!  Check out the current positions we are looking to fill below….if any of them jump out at you, simply drop us an email at <a href="mailto:careers@niffler.co">careers@niffler.co</a>  with the subject line Attn: HR.  Don’t forget to attach a resume or link to your LinkedIn bio as well as a brief paragraph on why you believe your the right person for us to bring on this exciting journey! </p>

                        <h5 class="text-uppercase mb-4">Current Opportunities</h5>

                        <div id="accordion">
						  <div class="card mb-3">
						    <div class="card-header p-0" id="headingOne">
						      <h5 class="mb-0 ">
						       <a class="d-block tab--heading px-4 py-4" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
						          <i class="fas fa-briefcase mr-2"></i>  Senior Software Engineer - Crypto/Payments
						        </a>
						      </h5>
						    </div> 

						    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
						      <div class="card-body">
						         <p class="lead">Responsibilities: </p>

								<p>Writing reusable, testable, and efficient code<br/>
								Work on developing our blockchain solution and securing our advanced trade platform<br/>
								Security guidance and tool development<br/>
								Integrate our financial systems with blockchain currencies and banks <br/>
								Implementation of security and data protection <br/>
								Design and implementation of low-latency, high-availability, and performance applications<br/> 
								Integration of data storage solutions <br/>
								Write highly scalable, high volume services</p> 

								<p class="lead">Requirements:</p>

								<p>3-5 years of experience as a backend developer <br/>
								Strong proficiency with Node.js and various frameworks <br/>
								Understanding the nature of asynchronous programming and its quirks and workarounds<br/> 
								Understanding accessibility and security compliance <br/>
								User authentication and authorization between multiple systems, servers, and environments 
								Integration of multiple data sources and databases into one system <br/>
								Understanding fundamental design principles behind a scalable application <br/>
								Understanding differences between multiple delivery platforms, such as mobile vs. desktop<br/>
								Creating database schemas that represent and support business processes <br/>
								Implementing automated testing platforms and unit tests <br/>
								Proficient understanding of code versioning tools, such as Git <br/>
								Experience with other languages such as: C++, Java, or GoLang <br/>
								Strong passion for all cryptocurrencies</p>
						      </div>
						    </div>
						  </div>
						  <div class="card mb-3">
						    <div class="card-header p-0" id="headingTwo">
						      <h5 class="mb-0">
						      <a class="d-block tab--heading px-4 py-4" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
						          <i class="fas fa-briefcase mr-2"></i> Senior Software Engineer: Blockchain & Security Systems
						        </a>
						      </h5>
						    </div>
						    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
						      <div class="card-body">
						        <p class="lead">Responsibilities:</p>
								<p>Develop highly scalable blockchain wallets<br/>
								Improve key management system <br/>
								Integration of user-facing elements developed by front-end developers with server side logic <br/>
								Penetration testing and vulnerability research, with recommendation of threat mitigations<br/> 
								Writing reusable, testable, and efficient code</p>


								<p class="lead">Requirements:</p>
								<p>
								Minimum five years of software engineering experience <br/>
								Strong experience developing large-scale concurrent, event-driven distributed systems <br/>
								Passion to work on cryptography (and blockchains) <br/>
								Server side and blockchain experience is a plus<br/> 
								Must have very strong experience with either javascript/typescript, Go or python. C/C++ is a plus <br/>
								Must have at least a basic understanding of git<br/> 
								Strong CS fundamentals, including good working knowledge of algorithms, data structures, distributed systems <br/>
								Good practical knowledge of sql is a plus <br/>
								Rigor in engineering best-practices (e.g. code reviews, automated testing, CI etc.)<br/> 
								Passion for innovation and for working in early stage startups<br/>
								Experience in trading crypto-currency <br/>
								Working knowledge of Go, Python, git and Continuous Integration/ Deployment based workflows <br/>
								Formal training and experience in cryptography, systems security, cloud security and privacy, distributed database systems and data analytics
								</p>

						      </div>
						    </div>
						  </div>
						  <div class="card mb-3">
						    <div class="card-header p-0" id="headingThree">
						      <h5 class="mb-0">
						        <a class="d-block tab--heading px-4 py-4" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
						          <i class="fas fa-briefcase mr-2"></i> Head of Growth
						        </a>
						      </h5>
						    </div>
						    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
						      <div class="card-body">
						        <p class="lead">Responsibilities:</p>

								<p>Take a data-driven approach to understand the efficacy of channels and campaigns<br/>
								Develop and deploy a robust member engagement/retention strategy to manage member churn <br/>
								Convert insights into action in regards to member acquisition process from ideation to execution<br/>
								Responsible revenue growth <br/>
								Drive both online and offline marketing programs <br/>
								Manage and optimize current channels and identify new channels for expansion <br/>
								Define growth tactics and work closely with multiple teams to execute them <br/>
								Be responsible for building out a growth team as the company scales </p>


								<p class="lead">Requirements: </p>

								<p>Team player and culture contributor<br/>
								A 3-5 year proven track record of growing and marketing consumer applications<br/> 
								Be goal-oriented, data-driven, and a self-starter <br/>
								Previous experience managing and scaling inbound and outbound marketing channels </p>

						      </div>
						    </div>
						  </div>
						</div>



            		</div>
                    </div>
                </div>
                </div>
            </div>

  
            <!-- / Inner Wrapper -->
        </div>
        <!-- / Welcome Section --> 

    @endsection

@endsection