<?php $__env->startSection('content'); ?>
	<style>
	.main-container::-webkit-scrollbar {
		width: 0.3em;
	}
	 
	.main-container::-webkit-scrollbar-track {
		-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
	}
	 
	.main-container::-webkit-scrollbar-thumb {
	  background-color: #8aa4af;
	  outline: 1px solid slategrey;
	}
	.line {
		clear: both;
		padding-top: 20px;
		margin-bottom: 30px;
		border-bottom: 1px solid rgb(218, 217, 219);
	}
	.main-container{
		padding-right: 1%;
		padding-left: 2%;
		margin-top:2px;
		overflow-y: scroll; 
		overflow-x:hidden;
		height   : 500px;
	}
	.table-bordered {
		border: 1px solid #a8aeb1;
	}
	.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{
		border-top: 1px solid #a8aeb1 !important;
	}
	.table-bordered>thead>tr>th, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td{
		border: 1px solid #a8aeb1;
	}
	</style>
	<div class="main-container">
		
		<div id="getstarted">
			<!--<p class="well">
				The Draftdaily API provides a simple interface Merchants can use to programmatically interact with their websites and applications.
			</p>-->
			<div class="line"> </div>
			<h2 class="str"><b>Getting Started With Draftdaily API Documentation</b></h2>
			<div class="line"> </div>
			<p>
				To use this API, you will need to register yourself on api.draftdaily.com and create an App to use. Your application interacts with this service locally via HTTPS API calls.
			</p>
			
			<div class="page-header">
				<h3 class="str" > 
					Steps to be follow : 
				</h3>
				
				<ol>
					<li><font color="grey">Register to our APIs Portal </font><a class="str" href="http://api.draftdaily.com">api.draftdaily.com</a></li>
					<li><font color="grey">Create A New App for your domain</font>.</li>
					<li><font color="grey">Fill all required information for app creation</font>.</li>
					<li><font color="grey">After successfully app created it will listed in your App list section as pending for approval</font>.</li>
					<li><font color="grey">After successfully app created it will automatically proccessed for <a class="str" href="javascript:void(0);">draftdaily</a> admin approval</font>.</li>
					<li><font color="grey">Once App will approved by <a class="str" href="javascript:void(0);">draftdaily</a> admin its status going to live and now you use the app.</font>.</li>
					
					<li><font color="grey">Base_url : </font><a class="str" href="javascript:void(0);">http://api.draftdaily.com/api/v1</a></li>
					<li><font color="grey">Get building</font>.</li>
					
				</ol>
			</div>		
		</div>
		
		<div id="auth">
			<div class="line"> </div>
			<h2 class="str"><b>Auth API</b></h2>
			<div class="line"> </div>
			
			<p>This API is used for App Authentication.</p>
			
			<div class="page-header">
				<table class="table table-bordered">
					<tbody>
						<tr>
							<th class="str" scope="row">URL</th>
							<td><font color="grey"> {Base_url}</font>/app/auth</td>				  
						</tr>
						<tr>
							<th class="str" scope="row">Method</th>
							<td>POST</td>					 
						</tr>
						<tr>
							<th class="str" scope="row">Parameters</th>
							<td>
								<ul>
									<li><b>AppId</b> is your App Id.</li>
									<li><b>SecretId</b> is your App Secret Id.</li>
								</ul> 
							</td>					 
						</tr>					
					</tbody>
				</table>
				
				<h6>Request: <small>application/json</small></h6>
				<pre class="prettyprint str">
				{
					"AppId":"2147483647",
					"SecretId":"xAuBzI3dxVU"
				}
				</pre>
				
				<h6>Response: <small>200 OK, application/json</small></h6>
				<pre class="prettyprint str">
				{
					"error": 0,
					"message": "Authentication successful",
					"data": {
						"accessToken": "gldRy9gjXE5UvC4dSNy1NszpJYQocET3pWzPW6F088ZSc47LF7p7bV6HMgVb"
					},
					"status": 200
				}
				</pre>
			</div>
		</div>
		
		<div id="get-country-list">
			<div class="line"> </div>
			<h2 class="str"><b>Get-Country-List API</b></h2>
			<div class="line"> </div>
			
			<p>This API is used to get all valid country list.</p>
			
			<div class="page-header">
				<table class="table table-bordered">
					<tbody>
						<tr>
							<th class="str" scope="row">URL</th>
							<td><font color="grey"> {Base_url}</font>/get-country-list</td>				  
						</tr>
						<tr>
							<th class="str" scope="row">Method</th>
							<td>POST</td>					 
						</tr>
						<tr>
							<th class="str" scope="row">Parameters</th>
							<td>
								<ul>
									<li><b>accessToken</b> is token key generated from App Auth API.</li>
								</ul> 
							</td>					 
						</tr>					
					</tbody>
				</table>
				
				<h6>Request: <small>application/json</small></h6>
				<pre class="prettyprint str">
				{
					"accessToken":"2147483647"
				}
				</pre>
				
				<h6>Response: <small>200 OK, application/json</small></h6>
				<pre class="prettyprint str">
				{
					"error": 0,
					"message": "All Available Active Country List",
					"data": [
						{
							"country_id": 233,
							"country_code": "US",
							"country_name": "United States"
						},
						{
							"country_id": 1,
							"country_code": "AD",
							"country_name": "Andorra"
						},
						{
							"country_id": 2,
							"country_code": "AE",
							"country_name": "United Arab Emirates"
						},
						
					],
					"status": 200
				}
				</pre> 
			</div>
		</div>
		
		<div id="get-state-list">
			<div class="line"> </div>
			<h2 class="str"><b>Get-State-List API</b></h2>
			<div class="line"> </div>
			
			<p>This API is used get all list of states by its country Id.</p>
			
			<div class="page-header">
				<table class="table table-bordered">
					<tbody>
						<tr>
							<th class="str" scope="row">URL</th>
							<td><font color="grey"> {Base_url}</font>/get-state-list</td>				  
						</tr>
						<tr>
							<th class="str" scope="row">Method</th>
							<td>POST</td>					 
						</tr>
						<tr>
							<th class="str" scope="row">Parameters</th>
							<td>
								<ul>
									<li><b>accessToken</b> is token key generated from App Auth API.</li>
									<li><b>country_id</b> is country Id get from get-country-list API.</li>
								</ul> 
							</td>					 
						</tr>					
					</tbody>
				</table>
				
				
				<h6>Request: <small>application/json</small></h6>
				<pre class="prettyprint str">
				{
					"accessToken":"2CyQZwc5Claj0eFrTfrF8icpqb1b2mgaLyqHc1RN5lGxV7JUHf0Fa8KMc37Y",
					"country_id":"233"
				}
				</pre>
				
				<h6>Response: <small>200 OK, application/json</small></h6>
				<pre class="prettyprint str">
				{
					"error": 0,
					"message": "All Available Active State List of provided country id",
					"data": [
						{
							"id": 3769,
							"name": "Alabama",
							"country_id": 233
						},
						{
							"id": 3770,
							"name": "Alaska",
							"country_id": 233
						},
						{
							"id": 3771,
							"name": "Arizona",
							"country_id": 233
						},
					]
				}
				</pre>
			</div>
		</div>
		
		<div id="register">
			<div class="line"> </div> 
			<h2 class="str"><b>Register Account API</b></h2>
			<div class="line"> </div>
			
			<p>This API used to register new user.</p>
			
			<div class="page-header">
				<table class="table table-bordered">
					<tbody>
						<tr>
							<th class="str" scope="row">URL</th>
							<td><font color="grey"> {Base_url}</font>/register-account</td>				  
						</tr>
						<tr>
							<th class="str" scope="row">Method</th>
							<td>POST</td>					 
						</tr>
						<tr>
							<th class="str" scope="row">Parameters</th>
							<td>
								<ul>
									<li><b>accessToken</b> is token key generated from App Auth API.</li>
									<li><b>user_name</b> should be unique and valid.</li>
									<li><b>email</b> should be unique and valid.</li>
									<li><b>password</b> should be min length of 8 char and max 25 and containing least one char and one digit.</li>
									<li><b>password_confirmation</b> should be min length of 8 char and max 25 and containing least one char and one digit same as password.</li>
									<li><b>country_id</b> is country id of user taken from get-country-list API.</li>
									<li><b>state_id</b> is state id of user taken from get-state-list API.</li>
								</ul> 
							</td>					 
						</tr>					
					</tbody>
				</table>
				
				<h6>Request: <small>application/json</small></h6>
				<pre class="prettyprint str">
				{
					"accessToken":"gldRy9gjXE5UvC4dSNy1NszpJYQocET3pWzPW6F088ZSc47LF7p7bV6HMgVb",
					"user_name":"pk2apitest",
					"email":"pk123@gmail.com",
					"password":"test12345",
					"password_confirmation":"test12345",
					"country_id":"233",
					"state_id":"3769"
				}
				</pre>
				
				<h6>Response: <small>200 OK, application/json</small></h6>
				<pre class="prettyprint str">
				{
					"error": 0,
					"message": "User registration has been successfully done.",
					"data": {
						"user_name": "pk2apitest",
						"email": "pk123@gmail.com",
						"password": "c06db68e819be6ec3d26c6038d8e8d1f",
						"country_id": "233",
						"state_id": "3769",
						"status": 1,
						"role": 1,
						"email_verify_status": 1,
						"activationLink": "QDE0NTI3MzE1",
						"user_id": 1064
					},
					"status": 200
				}
				</pre>
			</div>
		</div>
		
		<div id="login">
			<div class="line"> </div>
			<h2 class="str"><b>User Login API</b></h2>
			<div class="line"> </div>			
			<p>This API is used for user login.</p>
			
			<div class="page-header">
				<table class="table table-bordered">
					<tbody>
						<tr>
							<th class="str" scope="row">URL</th>
							<td><font color="grey"> {Base_url}</font>/user-login</td>				  
						</tr>
						<tr>
							<th class="str" scope="row">Method</th>
							<td>POST</td>					 
						</tr>
						<tr>
							<th class="str" scope="row">Parameters</th>
							<td>
								<ul>
									<li><b>accessToken</b> is token key generated from App Auth API.</li>
									<li><b>user_name</b> is Username.</li>
									<li><b>password</b> is Password.</li>
								</ul> 
							</td>					 
						</tr>					
					</tbody>
				</table>
				
				<h6>Request: <small>application/json</small></h6>
				<pre class="prettyprint str">
				{
					"accessToken":"gldRy9gjXE5UvC4dSNy1NszpJYQocET3pWzPW6F088ZSc47LF7p7bV6HMgVb",
					"user_name":"pk2apitest",
					"password":"test12345"
				}
				</pre>
				
				<h6>Response: <small>200 OK, application/json</small></h6>
				<pre class="prettyprint str">
				{
					"error": 0,
					"message": "User logged in successfully.",
					"data": {
						"user_id": 1064,
						"user_name": "pk2apitest",
						"fname": "",
						"lname": "",
						"email": "pk123@gmail.com",
						"wallet_address": null,
						"authToken": "9971730275a43a4dd9baad"
					},
					"status": 200
				}
				</pre>
			</div>
		</div>
		
		<div id="user-logout">
			<div class="line"> </div>
			<h2 class="str"><b>User Logout API</b></h2>
			<div class="line"> </div>			
			<p>This API is used for user logout.</p>
			<div class="page-header">
				<table class="table table-bordered">
					<tbody>
						<tr>
							<th class="str" scope="row">URL</th>
							<td><font color="grey"> {Base_url}</font>/user-logout</td>				  
						</tr>
						<tr>
							<th class="str" scope="row">Method</th>
							<td>POST</td>					 
						</tr>
						<tr>
							<th class="str" scope="row">Parameters</th>
							<td>
								<ul>
									<li><b>accessToken</b> is token key generated from App Auth API.</li>
									<li><b>user_id</b> is user id of logged in user.</li>
									<li><b>authToken</b> is authToken of logged in user.</li>
								</ul> 
							</td>					 
						</tr>					
					</tbody>
				</table>
				
				<h6>Request: <small>application/json</small></h6>
				<pre class="prettyprint str">
				{
					"accessToken":"gldRy9gjXE5UvC4dSNy1NszpJYQocET3pWzPW6F088ZSc47LF7p7bV6HMgVb",
					"user_id":"1064",
					"authToken":"9971730275a43a4dd9baad"
				}
				</pre>
				
				<h6>Response: <small>200 OK, application/json</small></h6>
				<pre class="prettyprint str">
				{
					"error": 0,
					"message": "User logged out successfully.",
					"data": {
						"user_id": 1064
					},
					"status": 200
				}
				</pre>
			</div>
		</div>
		
		<div id="get-user-account-detail">
			<div class="line"> </div>
			<h2 class="str"><b>User Account Detail API</b></h2>
			<div class="line"> </div>			
			<p>This API is used to get user account detail.</p>
			<div class="page-header">
				<table class="table table-bordered">
					<tbody>
						<tr>
							<th class="str" scope="row">URL</th>
							<td><font color="grey"> {Base_url}</font>/get-user-account-detail</td>				  
						</tr>
						<tr>
							<th class="str" scope="row">Method</th>
							<td>POST</td>					 
						</tr>
						<tr>
							<th class="str" scope="row">Parameters</th>
							<td>
								<ul>
									<li><b>accessToken</b> is token key generated from App Auth API.</li>
									<li><b>user_id</b> is user id of logged in user.</li>
									<li><b>authToken</b> is authToken of logged in user.</li>
								</ul> 
							</td>					 
						</tr>					
					</tbody>
				</table>
				
				<h6>Request: <small>application/json</small></h6>
				<pre class="prettyprint str">
				{
					"accessToken":"gldRy9gjXE5UvC4dSNy1NszpJYQocET3pWzPW6F088ZSc47LF7p7bV6HMgVb",
					"user_id":"1064",
					"authToken":"9971730275a43a4dd9baad"
				}
				</pre>
				
				<h6>Response: <small>200 OK, application/json</small></h6>
				<pre class="prettyprint str">
				{
					"error": 0,
					"message": "User Account Details.",
					"data": {
						"user_id": 1064,
						"settings": "abc",
						"address": "abc",
						"balance_amt": 0,
						"last_deposite": 0,
						"fpp": 0,
						"available_tickets": "21",
						"used_tickets": 0,
						"bonus_amt": 0,
						"address1": "",
						"imageurl": "",
						"secure_code": ""
					},
					"status": 200
				}
				</pre>
			</div>
		</div>
		
		<div id="get-sports">
			<div class="line"> </div>
			<h2 class="str"><b>Get-sports API</b></h2>
			<div class="line"> </div>			
			<p>This API is used to get sports.</p>
			<div class="page-header">
				<table class="table table-bordered">
					<tbody>
						<tr>
							<th class="str" scope="row">URL</th>
							<td><font color="grey"> {Base_url}</font>/get-sports</td>				  
						</tr>
						<tr>
							<th class="str" scope="row">Method</th>
							<td>POST</td>					 
						</tr>
						<tr>
							<th class="str" scope="row">Parameters</th>
							<td>
								<ul>
									<li><b>accessToken</b> is token key generated from App Auth API.</li>
								</ul> 
							</td>					 
						</tr>					
					</tbody>
				</table>
			
				<h6>Request: <small>application/json</small></h6>
				<pre class="prettyprint str">
				{
					"accessToken":"gldRy9gjXE5UvC4dSNy1NszpJYQocET3pWzPW6F088ZSc47LF7p7bV6HMgVb",
				}
				</pre>
				
				<h6>Response: <small>200 OK, application/json</small></h6>
				<pre class="prettyprint str">
				{
					"error": 0,
					"message": "Sports Details.",
					"data": [
						{
							"sports_id": 1,
							"display_name": "NFL",
							"status": 1
						},
						{
							"sports_id": 3,
							"display_name": "NBA",
							"status": 1
						},
						{
							"sports_id": 4,
							"display_name": "NHL",
							"status": 1
						}
					],
					"status": 200
				}
				</pre>
			</div>
		</div>
			
		<div id="get-contest-type">
			<div class="line"> </div>
			<h2 class="str"><b>Get-contest-type API</b></h2>
			<div class="line"> </div>			
			<p>This API is used to Get contest types.</p>
			
			<div class="page-header">
				<table class="table table-bordered">
					<tbody>
						<tr>
							<th class="str" scope="row">URL</th>
							<td><font color="grey"> {Base_url}</font>/get-contest-type</td>				  
						</tr>
						<tr>
							<th class="str" scope="row">Method</th>
							<td>POST</td>					 
						</tr>
						<tr>
							<th class="str" scope="row">Parameters</th>
							<td>
								<ul>
									<li><b>accessToken</b> is token key generated from App Auth API.</li>
								</ul> 
							</td>					 
						</tr>					
					</tbody>
				</table>
				
				<h6>Request: <small>application/json</small></h6>
				<pre class="prettyprint str">
				{
					"accessToken":"gldRy9gjXE5UvC4dSNy1NszpJYQocET3pWzPW6F088ZSc47LF7p7bV6HMgVb",
				}
				</pre>
				
				<h6>Response: <small>200 OK, application/json</small></h6>
				<pre class="prettyprint str">
				{
					"error": 0,
					"message": "Contest Type Details.",
					"data": [
						{
							"con_type_id": 1,
							"display_name": "Guaranteed",
							"status": 1
						},
						{
							"con_type_id": 2,
							"display_name": "Qualifiers",
							"status": 1
						},
						{
							"con_type_id": 3,
							"display_name": "Head-To-Head",
							"status": 1
						},
						{
							"con_type_id": 4,
							"display_name": "50-50",
							"status": 1
						},
						{
							"con_type_id": 5,
							"display_name": "Leagues",
							"status": 1
						},
						{
							"con_type_id": 6,
							"display_name": "Multipliers",
							"status": 1
						}
					],
					"status": 200
				}
				</pre>
			</div>
		</div>
			
		<div id="get-matches">
			<div class="line"> </div>
			<h2 class="str"><b>Get-matches API</b></h2>
			<div class="line"> </div>			
			<p>This API is used to Get matches.</p>
			<div class="page-header">
				<table class="table table-bordered">
					<tbody>
						<tr>
							<th class="str" scope="row">URL</th>
							<td><font color="grey"> {Base_url}</font>/get-matches</td>				  
						</tr>
						<tr>
							<th class="str" scope="row">Method</th>
							<td>POST</td>					 
						</tr>
						<tr>
							<th class="str" scope="row">Parameters</th>
							<td>
								<ul>
									<li><b>accessToken</b> is token key generated from App Auth API.</li>
									<li><b>sports_id</b> is Sports id taken from Get-sports API.</li>
									<li><b>game_date</b> is date of which match you want date should be "Y-m-d" format.</li>
								</ul> 
							</td>					 
						</tr>					
					</tbody>
				</table>
				
				<h6>Request: <small>application/json</small></h6>
				<pre class="prettyprint str">
				{
					"accessToken":"gldRy9gjXE5UvC4dSNy1NszpJYQocET3pWzPW6F088ZSc47LF7p7bV6HMgVb",
					"game_date":"2017-12-27",
					"sports_id":"1"
				}
				</pre>
				
				<h6>Response: <small>200 OK, application/json</small></h6>
				<pre class="prettyprint str">
				{
					"error": 0,
					"message": "Match data available.",
					"data": [
						{
							"game_id": "66017",
							"time": "1:00 PM",
							"date": "31.12.2017"
						},
						{
							"game_id": "66018",
							"time": "1:00 PM",
							"date": "31.12.2017"
						},
						{
							"game_id": "66020",
							"time": "1:00 PM",
							"date": "31.12.2017"
						},
						{
							"game_id": "66021",
							"time": "1:00 PM",
							"date": "31.12.2017"
						},
					],
					"status": 200
				}
				</pre>
			</div>
		</div>
			
		<div id="create-new-contest">
			<div class="line"> </div>
			<h2 class="str"><b>Create-new-contest API</b></h2>
			<div class="line"> </div>			
			<p>This API is used to a create-new-contest.</p>
			<div class="page-header">
				<table class="table table-bordered">
					<tbody>
						<tr>
							<th class="str" scope="row">URL</th>
							<td><font color="grey"> {Base_url}</font>/create-new-contest</td>				  
						</tr>
						<tr>
							<th class="str" scope="row">Method</th>
							<td>POST</td>					 
						</tr>
						<tr>
							<th class="str" scope="row">Parameters</th>
							<td>
								<ul>
									<li><b>accessToken</b> is token key generated from App Auth API.</li>
									<li><b>authToken</b> is authToken of logged in user.</li>
									<li><b>user_id</b> is reuired field.</li>
									<li><b>sports_id</b> is reuired field taken from get-sports API.</li>
									<li><b>contest_name</b> is required field.</li>
									
									<li><b>contest_type</b> is required field taken from get-contest-type API.
										<ul>
											<li>1=> Gauranteed.</li>
											<li>2=> Qualifiers.</li>
											<li>3=> Head-To-Head.</li>
											<li>4=> 50/50.</li>
											<li>5=> Leagues.</li>
											<li>6=> Multipliers.</li>
										</ul>
									<li><b>entry_limit</b> denotes how many user can ener to this contest and it is required field.</li>
									<li><b>challenge_limit</b> is required field.</li>
									<li><b>fee</b> is entry fee and it is required field.</li>
									<li><b>match_id</b> is required field taken from get-matches API.</li>
									<li><b>start_time</b> is required field it should be "Y-m-d H:i:s" format.</li>
									<li><b>prize_pool</b> is required field.</li>
									<li><b>play_type</b> is required field.
										<ul>
											<li>1=> Anyone.</li>
											<li>2=> friends.</li>
										</ul>
									</li>
									
									<li><b>prize_type</b> is required field prize_type can be.</br>
										For contest_type 50/50 must have prize_type equal to 5, and for Head-To-Head prize_type must have 1.
										<ul>
											<li>0=> No prize.</li>
											<li>1=> Top one winner.</li>
											<li>2=> Top two winner.</li>
											<li>5=> 50/50 winner.</li>
											<li>6=> Custom prize distribution.
												<ol>
													<li><b>rank_from.</b> is an array.</li>
													<li><b>rank_to.</b> is an array.</li>
													<li><b>payout_type</b> 0 for amount 1 for ticket and it is an array </li>
													<li><b>rank_amt</b> is a array.</li>
													<li><b>ticket_id</b></li>
													<li>there are three array rank_from rank_to and rank_amt for eg. 
													rank_from(
														[0] => 1
														[1] => 6
														[2] => 11
													)
													rank_to(
														[0] => 5
														[1] => 10
														[2] => 15
													)
													payout_type(
														[0] => 0
														[1] => 0
														[2] => 1
													)
													rank_amt(
														[0] => 50
														[1] => 40
													)
													ticket_id(
														[0] => 41
													).
													</li>
												</ol>
											</li>
										</ul>
									</li>
									
									<li><b>desctext</b> is description and required field.</li>
								</ul> 
							</td>					 
						</tr>					
					</tbody>
				</table>
				
				<h6>Request: <small>application/json</small></h6>
				<pre class="prettyprint str">
				{
					"accessToken":"I6Ah5nXYAYSEYPbqinsUWA2UY66y9QeqHNkBKlZ53rrJXnXe6L1xrCvsfDsc",
					"authToken":"17958680215a45fa8c91c4d",
					"user_id":"243",
					"sports_id":"1",
					"contest_name":"NFL BOOM 1",
					"contest_type":"4",
					"entry_limit":"10",
					"challenge_limit":"2",
					"fee":"500",
					"match_id":"2345",
					"start_time":"2017-12-27 12:30:30",
					"prize_pool":"800",
					"play_type":"1",
					"prize_type":"2",
					"desctext":"this is test contest by api user"
				}
				</pre>
				
				<h6>Response: <small>200 OK, application/json</small></h6>
				<pre class="prettyprint str">
				{
					"error": 0,
					"message": "Contest has been created successfully.",
					"data": {
						"contest_id": 1510
					},
					"status": 200
				}
				</pre>
			</div>
		</div>
		
		<div id="get-contest">
			<div class="line"> </div>
			<h2 class="str"><b>Get-contest API</b></h2>
			<div class="line"> </div>			
			<p>This API is used to Get contest.</p>
			<div class="page-header">
				<table class="table table-bordered">
					<tbody>
						<tr>
							<th class="str" scope="row">URL</th>
							<td><font color="grey"> {Base_url}</font>/get-contest</td>				  
						</tr>
						<tr>
							<th class="str" scope="row">Method</th>
							<td>POST</td>					 
						</tr>
						<tr>
							<th class="str" scope="row">Parameters</th>
							<td>
								<ul>
									<li><b>accessToken</b> is token key generated from App Auth API.</li>
									<li><b>authToken</b> is authToken of logged in user.</li>
									<li><b>user_id</b> is required field..</li>
									<li><b>contest_id</b> is not required field if sent then it get particular contest otherwise all active contest.</li>
								</ul> 
							</td>					 
						</tr>					
					</tbody>
				</table>
				
				<h6>Request: <small>application/json</small></h6>
				<pre class="prettyprint str">
				{
					"accessToken":"I6Ah5nXYAYSEYPbqinsUWA2UY66y9QeqHNkBKlZ53rrJXnXe6L1xrCvsfDsc",
					"authToken":"17958680215a45fa8c91c4d",
					"contest_id":1510,
					"user_id":"243"
				}
				</pre>
				
				<h6>Response: <small>200 OK, application/json</small></h6>
				<pre class="prettyprint str">
				{
					"error": 0,
					"message": "Contest details.",
					"data": {
						"contest_id": 1510,
						"contest_name": "NFL BOOM 1",
						"sports_id": 1,
						"con_type_id": 4,
						"entry_fee": 500,
						"challenge_limit": 2,
						"play_limit": 10,
						"play_type": 1,
						"find_me": 0,
						"start_time": "2017-12-27 12:30:00",
						"end_time": "2017-12-31 20:25:00",
						"prizes": 0,
						"status": 0,
						"con_status": 3,
						"prize_pool": 800,
						"match_id": 2345,
						"fpp": 1650,
						"created_by": 243,
						"total_entry": 0,
						"description": "this is test contest by api user",
						"prize_payouts": "[{\"from\":1,\"to\":5,\"type\":0,\"amount\":160,\"ticket_id\":null}]",
						"is_featured": 0,
						"ticket_id": 0,
						"offers_to": "",
						"start_time_mail": 1
					},
					"status": 200
				}
				</pre>
			</div>
		</div>
		
		<div id="get-filter-player">
			<div class="line"> </div>
			<h2 class="str"><b>Get-filter-player API</b></h2>
			<div class="line"> </div>			
			<p>This API is used to Get player.</p>
			<div class="page-header">
				<table class="table table-bordered">
					<tbody>
						<tr>
							<th class="str" scope="row">URL</th>
							<td><font color="grey"> {Base_url}</font>/get-filter-player</td>				  
						</tr>
						<tr>
							<th class="str" scope="row">Method</th>
							<td>POST</td>					 
						</tr>
						<tr>
							<th class="str" scope="row">Parameters</th>
							<td>
								<ul>
									<li><b>accessToken</b> is token key generated from App Auth API.</li>
									<li><b>authToken</b> is authToken of logged in user.</li>
									<li><b>user_id</b> is reuired field.</li>
									<li><b>contest_id</b> is reuired field taken from get-contest API.</li>
									<li><b>searchKey</b> is required field and 'searchKey' always as 'pos_code'.</li>
									<li><b>searchValue</b> is required field and 'searchValue' is 'P','C','1B','2B','3B','SS','OF','ALL' respectively.</li>
									<li><b>sports_id</b> is required field and taken from get-sports API.</li>
									<li><b>method:</b>
										<ol>
											<li><b>teamfilter</b>
												<ul>
													<li><b>team</b> is required.</li>
												</ul>
											</li>
											
											<li><b>playerfilter</b>
												<ul>
													<li><b>selectedTeam</b> is required.</li>
												</ul>
											</li>
											<li><b>playerByTeam</b>
												<ul>
													<li><b>searchPos</b> is required.</li>
													<li><b>searchTeam</b> is required.</li>
												</ul>
											</li>
										</ol>
									</li>
								</ul> 
							</td>					 
						</tr>					
					</tbody>
				</table>
				
				
				<h6>Request: <small>application/json</small></h6>
				<pre class="prettyprint str">
				{
					"accessToken":"I6Ah5nXYAYSEYPbqinsUWA2UY66y9QeqHNkBKlZ53rrJXnXe6L1xrCvsfDsc",
					"user_id":"1064",
					"authToken":"10096165795a44bfc306ae7",
					"contest_id":"1506",
					"searchKey":"pos_code",
					"searchValue":"P",
					"sports_id":"3",
					"method":"playerfilter"
				}
				</pre>
				
				<h6>Response: <small>200 OK, application/json</small></h6>
				<pre class="prettyprint str">
				{
					"error": 0,
					"message": "All record.",
					"data": [
						{
							"number": "9",
							"name": "DeMarre Carroll",
							"position": "SF",
							"college": "Missouri",
							"age": "31",
							"height": "6-8",
							"weight": "215",
							"id": "3970",
							"team_name": "Brooklyn Nets",
							"pos_code": "SF",
							"team_code": "Bkn",
							"team_vs": "Mia",
							"team_id": "8055",
							"fppg": "27.3",
							"plr_value": 5900,
							"injury_status": 0
						},
						{
							"number": "31",
							"name": "Mike Muscala",
							"position": "PF",
							"college": "Bucknell",
							"age": "26",
							"height": "6-11",
							"weight": "240",
							"id": "2490089",
							"team_name": "Atlanta Hawks",
							"pos_code": "PF",
							"team_code": "Atl",
							"team_vs": "Tor",
							"team_id": "1182",
							"fppg": "16.18",
							"plr_value": 3500,
							"injury_status": 0
						},
						{
							"number": "17",
							"name": "Dennis Schroder",
							"position": "PG",
							"college": "",
							"age": "24",
							"height": "6-1",
							"weight": "172",
							"id": "3032979",
							"team_name": "Atlanta Hawks",
							"pos_code": "PG",
							"team_code": "Atl",
							"team_vs": "Tor",
							"team_id": "1182",
							"fppg": "35.21",
							"plr_value": 8000,
							"injury_status": 0
						},
						{
							"number": "30",
							"name": "Mike Scott",
							"position": "PF",
							"college": "Virginia",
							"age": "29",
							"height": "6-8",
							"weight": "237",
							"id": "6622",
							"team_name": "Washington Wizards",
							"pos_code": "PF",
							"team_code": "Wsh",
							"team_vs": "Hou",
							"team_id": "1218",
							"fppg": "16.72",
							"plr_value": 3200,
							"injury_status": 0
						},
					],
					"status": 200
				}
				</pre>
			</div>
		</div>
		
		<div id="new-lineup">
			<div class="line"> </div>
			<h2 class="str"><b>New-lineup API</b></h2>
			<div class="line"> </div>			
			<p>This API is used to create new lineup.</p>
			<div class="page-header">
				<table class="table table-bordered">
					<tbody>
						<tr>
							<th class="str" scope="row">URL</th>
							<td><font color="grey"> {Base_url}</font>/new-lineup</td>				  
						</tr>
						<tr>
							<th class="str" scope="row">Method</th>
							<td>POST</td>					 
						</tr>
						<tr>
							<th class="str" scope="row">Parameters</th>
							<td>
								<ul>
									<li><b>accessToken</b> is token key generated from App Auth API.</li>
									<li><b>authToken</b> is authToken of logged in user.</li>
									<li><b>user_id</b> is reuired field.</li>
									<li><b>sports_id</b> is reuired field taken from get-sports API.</li>
									<li><b>conid</b> is lineup contest Id and it is required field.</li>
									<li><b>start_time</b> is required field date should be like "Y-m-d H:i:s".</li>
									<li><b>rem_salary</b> is remaining salary after all player selected.</li>
									<li><b>pos_details</b> is an array of all lineup position players.</li>
									<li><b>player_ids</b> is an array of all lineup players.</li>
								</ul> 
							</td>					 
						</tr>					
					</tbody>
				</table>
				
				
				<h6>Request: <small>application/json</small></h6>
				<pre class="prettyprint str">
				{
					"accessToken":"I6Ah5nXYAYSEYPbqinsUWA2UY66y9QeqHNkBKlZ53rrJXnXe6L1xrCvsfDsc",
					"authToken":"17958680215a45fa8c91c4d",					
					"user_id":"243",
					"conid":"1524",
					"start_time":"2017-12-29 12:11:12",
					"rem_salary":"243",
					"sports_id":"4",
					"pos_details":[{"5374": "C"}, {"3067870": "C"},{"163": "W"}, {"3592": "W"},{"3523": "W"}, {"343": "D"},{"2564322": "D"}, {"3937": "G"},{"2097": "UTIL"}],
					"player_ids":{"0": "5374","1": "3067870","2": "163","3": "3592","4": "3523","5": "343","6": "2564322","7": "3937","8": "2097"}
					
				}
				</pre>
				
				<h6>Response: <small>200 OK, application/json</small></h6>
				<pre class="prettyprint str">
				{
					"error": 0,
					"message": "Lineup has added successfully.",
					"data": {
						"lineupId": 1628
					},
					"status": 200
				}
				</pre>
			</div>
		</div>
		
		<div id="edit-lineup">
			<div class="line"> </div>
			<h2 class="str"><b>Edit-lineup API</b></h2>
			<div class="line"> </div>			
			<p>This API is used for edit lineups.</p>
			<div class="page-header">
				<table class="table table-bordered">
					<tbody>
						<tr>
							<th class="str" scope="row">URL</th>
							<td><font color="grey"> {Base_url}</font>/edit-lineup</td>				  
						</tr>
						<tr>
							<th class="str" scope="row">Method</th>
							<td>POST</td>					 
						</tr>
						<tr>
							<th class="str" scope="row">Parameters</th>
							<td>
								<ul>
									<li><b>accessToken</b> is token key generated from App Auth API.</li>
									<li><b>authToken</b> is authToken of logged in user.</li>
									<li><b>user_id</b> is reuired field.</li>
									<li><b>sports_id</b> is reuired field taken from get-sports API.</li>
									<li><b>start_time</b> is required field date should be like "Y-m-d H:i:s".</li>
									<li><b>rem_salary</b> is remaining salary after all player selected.</li>
									<li><b>lineup_id</b> is required for edit lineup.</li>
									<li><b>pos_details</b> is an array of all lineup position players.</li>
									<li><b>player_ids</b> is an array of all lineup players.</li>
								</ul> 
							</td>					 
						</tr>					
					</tbody>
				</table>
				
				
				<h6>Request: <small>application/json</small></h6>
				<pre class="prettyprint str">
				{
					"accessToken":"I6Ah5nXYAYSEYPbqinsUWA2UY66y9QeqHNkBKlZ53rrJXnXe6L1xrCvsfDsc",
					"authToken":"17958680215a45fa8c91c4d",
					"user_id":"243",
					"lineup_id":"1628",
					"start_time":"2017-12-29 12:11:12",
					"rem_salary":"243",
					"sports_id":"4",
					"pos_details":[{"5374": "C"}, {"3067870": "C"},{"163": "W"}, {"3592": "W"},{"3523": "W"}, {"343": "D"},{"2564322": "D"}, {"3937": "G"},{"2097": "UTIL"}],
					"player_ids":{"0": "5374","1": "3067870","2": "163","3": "3592","4": "3523","5": "343","6": "2564322","7": "3937","8": "2097"}
					
				}
				</pre>
				
				<h6>Response: <small>200 OK, application/json</small></h6>
				<pre class="prettyprint str">
				{
					"error": 0,
					"message": "Lineup has updated successfully.",
					"data": {
						"lineupId": "1628"
					},
					"status": 198
				}
				</pre>
			</div>
		</div>
		
		<div id="get-lineup-details">
			<div class="line"> </div>
			<h2 class="str"><b>Get-lineup-details API</b></h2>
			<div class="line"> </div>			
			<p>This API is used to get-lineup-details.</p>
			<div class="page-header">
				<table class="table table-bordered">
					<tbody>
						<tr>
							<th class="str" scope="row">URL</th>
							<td><font color="grey"> {Base_url}</font>/get-lineup-details</td>				  
						</tr>
						<tr>
							<th class="str" scope="row">Method</th>
							<td>POST</td>					 
						</tr>
						<tr>
							<th class="str" scope="row">Parameters</th>
							<td>
								<ul>
									<li><b>accessToken</b> is token key generated from App Auth API.</li>
									<li><b>authToken</b> is authToken of logged in user.</li>
									<li><b>user_id</b> is reuired field.</li>
									<li><b>lineup_id</b> is required for detail lineup.</li>
								</ul> 
							</td>					 
						</tr>					
					</tbody>
				</table>
				
				<h6>Request: <small>application/json</small></h6>
				<pre class="prettyprint str">
				{
					"accessToken":"I6Ah5nXYAYSEYPbqinsUWA2UY66y9QeqHNkBKlZ53rrJXnXe6L1xrCvsfDsc",
					"authToken":"17958680215a45fa8c91c4d",
					"user_id":"243",
					"lineup_id":"1628"
					
				}
				</pre>
				
				<h6>Response: <small>200 OK, application/json</small></h6>
				<pre class="prettyprint str">
				{
					"error": 0,
					"message": "Lineup details.",
					"data": {
						"user_lineup_id": 2245,
						"lineup_id": 1628,
						"contest_id": 1524,
						"con_rank": 0,
						"con_prize": 0,
						"con_prize_type": 0,
						"status": 1,
						"created_date": "2018-01-02 17:29:17",
						"sports_id": 4,
						"start_time": "2018-01-05 19:00:00",
						"end_time": "2018-01-05 23:30:00",
						"player_ids": "[\"5374\",\"3067870\",\"163\",\"3592\",\"3523\",\"343\",\"2564322\",\"3937\",\"2097\"]",
						"pos_details": "{\"5374\":\"C\",\"3067870\":\"C\",\"163\":\"W\",\"3592\":\"W\",\"3523\":\"W\",\"343\":\"D\",\"2564322\":\"D\",\"3937\":\"G\",\"2097\":\"UTIL\"}",
						"created_by": 4,
						"players_points": 0,
						"point_details": "",
						"scoring": "",
						"rank": 0,
						"prize": "0",
						"rem_salary": 243,
						"prize_type": 0,
						"bonus": 0,
						"contest_name": "NHL-FREE PLAY",
						"con_type_id": 1,
						"entry_fee": 0,
						"challenge_limit": 2,
						"play_limit": 25,
						"play_type": 1,
						"find_me": 0,
						"prizes": 0,
						"con_status": 0,
						"prize_pool": 0,
						"match_id": 22614,
						"fpp": 0,
						"total_entry": 1,
						"description": "THIS IS A FREE CONTEST NO PRIZE AWARDED.",
						"prize_payouts": "",
						"is_featured": 0,
						"ticket_id": 0,
						"offers_to": "",
						"start_time_mail": 1
					},
					"status": 200
				}
				</pre>
			</div>
		</div>
			
		<div id="remove-player">
			<div class="line"> </div>
			<h2 class="str"><b>Remove-player API</b></h2>
			<div class="line"> </div>			
			<p>This API is used to remove-player.</p>
			<div class="page-header">
				<table class="table table-bordered">
					<tbody>
						<tr>
							<th class="str" scope="row">URL</th>
							<td><font color="grey"> {Base_url}</font>/remove-player</td>				  
						</tr>
						<tr>
							<th class="str" scope="row">Method</th>
							<td>POST</td>					 
						</tr>
						<tr>
							<th class="str" scope="row">Parameters</th>
							<td>
								<ul>
									<li><b>accessToken</b> is token key generated from App Auth API.</li>
									<li><b>authToken</b> is authToken of logged in user.</li>
									<li><b>user_id</b> is reuired field.</li>
									<li><b>player_id</b> is required.</li>
									<li><b>lineup_id</b> is required.</li>
								</ul> 
							</td>					 
						</tr>					
					</tbody>
				</table>
				
				
				<h6>Request: <small>application/json</small></h6>
				<pre class="prettyprint str">
				{
					"accessToken":"I6Ah5nXYAYSEYPbqinsUWA2UY66y9QeqHNkBKlZ53rrJXnXe6L1xrCvsfDsc",
					"authToken":"17958680215a45fa8c91c4d",
					"user_id":"243",
					"lineup_id":"1628",
					"player_id":"5374"
					
				}
				</pre>
				
				<h6>Response: <small>200 OK, application/json</small></h6>
				<pre class="prettyprint str">
				{
					"error": 0,
					"message": "Player has been deleted successfully.",
					"data": {
						"player_id": "5374"
					},
					"status": 200
				}
				</pre>
			</div>
		</div>
				
		<div id="add-player">
			<div class="line"> </div>
			<h2 class="str"><b>Add-player API</b></h2>
			<div class="line"> </div>			
			<p>This API is used to add-player in to old lineup.</p>
			<div class="page-header">
				<table class="table table-bordered">
					<tbody>
						<tr>
							<th class="str" scope="row">URL</th>
							<td><font color="grey"> {Base_url}</font>/add-player</td>				  
						</tr>
						<tr>
							<th class="str" scope="row">Method</th>
							<td>POST</td>					 
						</tr>
						<tr>
							<th class="str" scope="row">Parameters</th>
							<td>
								<ul>
									<li><b>accessToken</b> is token key generated from App Auth API.</li>
									<li><b>authToken</b> is authToken of logged in user.</li>
									<li><b>user_id</b> is reuired field.</li>
									<li><b>player_id</b> is required.</li>
									<li><b>lineup_id</b> is required.</li>
									<li><b>player_position</b> is required.</li>
								</ul> 
							</td>					 
						</tr>					
					</tbody>
				</table>
				
				<h6>Request: <small>application/json</small></h6>
				<pre class="prettyprint str">
				{
					"accessToken":"I6Ah5nXYAYSEYPbqinsUWA2UY66y9QeqHNkBKlZ53rrJXnXe6L1xrCvsfDsc",
					"authToken":"17958680215a45fa8c91c4d",
					"user_id":"243",
					"lineup_id":"1628",
					"player_id":"5374",
					"player_position":"C"
					
				}
				</pre>
				
				<h6>Response: <small>200 OK, application/json</small></h6>
				<pre class="prettyprint str">
				{
					"error": 0,
					"message": "Player has been added successfully.",
					"data": {
						"player_id": "5374"
					},
					"status": 200
				}
				</pre>
			</div>
		</div>
			
		<div id="get-applicable-match">
			<div class="line"> </div>
			<h2 class="str"><b>Get-applicable-match API</b></h2>
			<div class="line"> </div>			
			<p>This API is used to get-applicable-match.</p>
			<div class="page-header">
				<table class="table table-bordered">
					<tbody>
						<tr>
							<th class="str" scope="row">URL</th>
							<td><font color="grey"> {Base_url}</font>/get-applicable-match</td>				  
						</tr>
						<tr>
							<th class="str" scope="row">Method</th>
							<td>POST</td>					 
						</tr>
						<tr>
							<th class="str" scope="row">Parameters</th>
							<td>
								<ul>
									<li><b>accessToken</b> is token key generated from App Auth API.</li>
									<li><b>authToken</b> is authToken of logged in user.</li>
									<li><b>user_id</b> is reuired field.</li>
									<li><b>sports_id</b> is reuired field taken from get-sports API.</li>
									<li><b>game_date</b> is required field it should be "Y-m-d H:i:s" format.</li>
								</ul> 
							</td>					 
						</tr>					
					</tbody>
				</table>
				
				
				<h6>Request: <small>application/json</small></h6>
				<pre class="prettyprint str">
				{
					"accessToken":"I6Ah5nXYAYSEYPbqinsUWA2UY66y9QeqHNkBKlZ53rrJXnXe6L1xrCvsfDsc",
					"authToken":"17958680215a45fa8c91c4d",
					"user_id":"243",
					"sports_id":"3",
					"game_date":"2018-01-01"
				}
				</pre>
				
				<h6>Response: <small>200 OK, application/json</small></h6>
				<pre class="prettyprint str">
				{
					"error": 0,
					"message": "Match data available.",
					"data": [
						{
							"match": [
								{
									"game_id": "112693",
									"time": "7:30 PM",
									"date": "1.01.2018"
								},
								{
									"game_id": "112694",
									"time": "7:30 PM",
									"date": "1.01.2018"
								},
								{
									"game_id": "112695",
									"time": "8:00 PM",
									"date": "1.01.2018"
								},
								{
									"game_id": "112696",
									"time": "8:00 PM",
									"date": "1.01.2018"
								}
							]
						},
						{
							"match": [
								{
									"game_id": "113281",
									"time": "7:00 PM",
									"date": "2.01.2018"
								},
								{
									"game_id": "113282",
									"time": "7:30 PM",
									"date": "2.01.2018"
								},
								{
									"game_id": "113283",
									"time": "9:00 PM",
									"date": "2.01.2018"
								},
								{
									"game_id": "113284",
									"time": "10:00 PM",
									"date": "2.01.2018"
								},
								{
									"game_id": "113285",
									"time": "10:30 PM",
									"date": "2.01.2018"
								}
							]
						}
					],
					"status": 200
				}
				</pre>
			</div>
		</div>
	
	</div>
	
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>