<?php
class Engine_Vault_Acl extends Zend_Acl
{
	public function __construct(){
		 // Add a new role called "guest"
		$this->addRole(new Zend_Acl_Role('guest'));
		// Add a role called user, which inherits from guest
		$this->addRole(new Zend_Acl_Role('user'), 'guest');
		// Add a role called admin, which inherits from user
		$this->addRole(new Zend_Acl_Role('admin'), 'user');
		
		$this->add(new Zend_Acl_Resource('home'))
			 ->add(new Zend_Acl_Resource('home::home'), 'home')
			 ->add(new Zend_Acl_Resource('home::error'), 'home')   
			 ->add(new Zend_Acl_Resource('home::error::error'), 'home::error')
			 ->add(new Zend_Acl_Resource('home::home::home'), 'home::home')
			 ->add(new Zend_Acl_Resource('home::home::contest-details'), 'home::home')  
			 ->add(new Zend_Acl_Resource('home::home::index'), 'home::home')
			 ->add(new Zend_Acl_Resource('home::home::email'), 'home::home')
			 ->add(new Zend_Acl_Resource('home::home::filter-sports'), 'home::home')
			 ->add(new Zend_Acl_Resource('home::home::promo'), 'home::home')
			 ->add(new Zend_Acl_Resource('home::home::contest-details-ajax'), 'home::home')
			 ->add(new Zend_Acl_Resource('home::home::contest-details-undraft'), 'home::home')
			 ->add(new Zend_Acl_Resource('home::home::promotions'), 'home::home') ; 
			
		$this->allow('guest', 'home::home::home')
			 ->allow('guest', 'home::home::index')
			 ->allow('guest', 'home::error::error')
			 ->allow('guest', 'home::home::contest-details')
			 ->allow('guest', 'home::home::email')
			 ->allow('guest', 'home::home::promo')
			 ->allow('user', 'home::home::filter-sports')
			 ->allow('user', 'home::home::contest-details-ajax')
			 ->allow('user', 'home::home::contest-details-undraft')
			 ->allow('user', 'home::home::promotions');
		
		/*
		 * Payment Module
		 */
		
		$this->add(new Zend_Acl_Resource('payment'))
			 ->add(new Zend_Acl_Resource('payment::payment'), 'payment')
			 ->add(new Zend_Acl_Resource('payment::payment::payment'), 'payment::payment')
			 ->add(new Zend_Acl_Resource('payment::payment::success'), 'payment::payment')
			 ->add(new Zend_Acl_Resource('payment::payment::payment-dfscoin'), 'payment::payment')
			 ->add(new Zend_Acl_Resource('payment::payment::purchase-dfscoin'), 'payment::payment')
			 ->add(new Zend_Acl_Resource('payment::payment::cancel-order'), 'payment::payment');
		
		$this->allow('user', 'payment::payment::payment');
		$this->allow('user', 'payment::payment::purchase-dfscoin');
		$this->allow('user', 'payment::payment::payment-dfscoin');
		$this->allow('user', 'payment::payment::success');
		$this->allow('user', 'payment::payment::cancel-order');
			 
		/*
		 * Authentication Module
		 */
		
		$this->add(new Zend_Acl_Resource('authentication'))
			 ->add(new Zend_Acl_Resource('authentication::authentication'), 'authentication')
			 ->add(new Zend_Acl_Resource('authentication::authentication::index'), 'authentication::authentication')
			 ->add(new Zend_Acl_Resource('authentication::authentication::login'), 'authentication::authentication')
			 ->add(new Zend_Acl_Resource('authentication::authentication::signup'), 'authentication::authentication')   
			 ->add(new Zend_Acl_Resource('authentication::authentication::ajaxHandler'), 'authentication::authentication')     
			 ->add(new Zend_Acl_Resource('payment::payment::callback-purchase-dfscoin'), 'payment::payment')     
			 ->add(new Zend_Acl_Resource('authentication::authentication::logout'), 'authentication::authentication')
			 ->add(new Zend_Acl_Resource('authentication::authentication::reset'), 'authentication::authentication')
			 ->add(new Zend_Acl_Resource('authentication::authentication::affiliate'), 'authentication::authentication')
			 ->add(new Zend_Acl_Resource('authentication::authentication::afflogin'), 'authentication::authentication')
			 ->add(new Zend_Acl_Resource('authentication::authentication::facebookauth'), 'authentication::authentication');
		
		$this->allow('guest', 'authentication::authentication::index')
			 ->allow('guest', 'payment::payment::callback-purchase-dfscoin')
			 ->allow('guest', 'authentication::authentication::login')
			 ->allow('guest', 'authentication::authentication::signup')
			 ->allow('guest','authentication::authentication::ajaxHandler')   
			 ->allow('guest', 'authentication::authentication::logout')
			 ->allow('guest', 'authentication::authentication::reset')
			 ->allow('guest', 'authentication::authentication::affiliate')
			 ->allow('guest', 'authentication::authentication::afflogin')
			 ->allow('guest', 'authentication::authentication::facebookauth');
		
		/*
		 * Admin Module
		 */
		 
		//module::con::action
		$this->add(new Zend_Acl_Resource('admin'))
			 ->add(new Zend_Acl_Resource('admin::admin'), 'admin')
			 ->add(new Zend_Acl_Resource('admin::admin::index'), 'admin::admin')
			 ->add(new Zend_Acl_Resource('admin::admin::logout'), 'admin::admin');                 
		
		$this->allow('guest', 'admin::admin::index');
		$this->allow('guest', 'admin::admin::logout');
				
		$this->add(new Zend_Acl_Resource('admin::game'), 'admin')
			 ->add(new Zend_Acl_Resource('admin::game::game-details'), 'admin::admin')
			 ->add(new Zend_Acl_Resource('admin::game::new-sports'), 'admin::admin')
			 ->add(new Zend_Acl_Resource('admin::game::new-game-details'), 'admin::admin')
			 ->add(new Zend_Acl_Resource('admin::game::edit-sport-details'), 'admin::admin');
		
		$this->allow('admin', 'admin::game::game-details')
			 ->allow('admin', 'admin::game::new-sports')
			 ->allow('admin', 'admin::game::new-game-details')
			 ->allow('admin', 'admin::game::edit-sport-details');
		
		$this->add(new Zend_Acl_Resource('admin::user'), 'admin')
			 ->add(new Zend_Acl_Resource('admin::user::user-details'), 'admin::admin')
			 ->add(new Zend_Acl_Resource('admin::user::edit-user'), 'admin::admin')
			 ->add(new Zend_Acl_Resource('admin::user::user-account-details'), 'admin::admin')
			 ->add(new Zend_Acl_Resource('admin::user::edit-account-details'), 'admin::admin')
				->add(new Zend_Acl_Resource('admin::user::manage-bots'), 'admin::admin')
			 ->add(new Zend_Acl_Resource('admin::user::manage-bots-ajax'), 'admin::admin')
			 ->add(new Zend_Acl_Resource('admin::user::mailer'), 'admin::admin')
				->add(new Zend_Acl_Resource('admin::user::fpp-exchange-log'), 'admin::admin');
		
		$this->allow('admin', 'admin::user::user-details')
			 ->allow('admin', 'admin::user::edit-user')
			 ->allow('admin', 'admin::user::user-account-details')
			 ->allow('admin', 'admin::user::edit-account-details')
				 ->allow('admin', 'admin::user::manage-bots')
			  ->allow('admin', 'admin::user::manage-bots-ajax')
			 ->allow('admin', 'admin::user::mailer')
				->allow('admin', 'admin::user::fpp-exchange-log');
		
		$this->add(new Zend_Acl_Resource('admin::promotion'), 'admin')
			 ->add(new Zend_Acl_Resource('admin::promotion::add-contest-promotion'), 'admin::promotion')
			 ->add(new Zend_Acl_Resource('admin::promotion::edit-contest-promotion'), 'admin::promotion')
			 ->add(new Zend_Acl_Resource('admin::promotion::contest-promotion'), 'admin::promotion');
		
		$this->allow('admin', 'admin::promotion::add-contest-promotion')
			 ->allow('admin', 'admin::promotion::edit-contest-promotion')
			 ->allow('admin', 'admin::promotion::contest-promotion');
		
		$this->add(new Zend_Acl_Resource('admin::payment'), 'admin')
			 ->add(new Zend_Acl_Resource('admin::payment::payment-details'), 'admin::admin')
			 ->add(new Zend_Acl_Resource('admin::payment::payment-approval'), 'admin::admin')
			 ->add(new Zend_Acl_Resource('admin::payment::withdrawal-details'), 'admin::admin')
			 ->add(new Zend_Acl_Resource('admin::payment::depositor-details'), 'admin::admin')
			 ->add(new Zend_Acl_Resource('admin::payment::profit-stats'), 'admin::admin')
			 ->add(new Zend_Acl_Resource('admin::payment::edit-status'), 'admin::admin');
			 
		
		$this->allow('admin', 'admin::payment::payment-details')
			 ->allow('admin', 'admin::payment::payment-approval')
			 ->allow('admin', 'admin::payment::withdrawal-details')
			 ->allow('admin', 'admin::payment::depositor-details')
			 ->allow('admin', 'admin::payment::profit-stats')
			  ->allow('admin', 'admin::payment::edit-status')  ;
			 
		
		$this->add(new Zend_Acl_Resource('admin::contest'), 'admin')
			 ->add(new Zend_Acl_Resource('admin::contest::contest-details'), 'admin::admin')
			 ->add(new Zend_Acl_Resource('admin::contest::match-details'), 'admin::admin')
			 ->add(new Zend_Acl_Resource('admin::contest::new-contest'), 'admin::admin')
			 ->add(new Zend_Acl_Resource('admin::contest::new-contest-type'), 'admin::admin')                 
			 ->add(new Zend_Acl_Resource('admin::contest::contest-type-details'), 'admin::admin')                 
			 ->add(new Zend_Acl_Resource('admin::contest::edit-contest'), 'admin::admin')                 
			 ->add(new Zend_Acl_Resource('admin::contest::edit-contest-type'), 'admin::admin')
			 ->add(new Zend_Acl_Resource('admin::contest::featured-contest'), 'admin::admin')
			 ->add(new Zend_Acl_Resource('admin::contest::get-contest'), 'admin::admin')
			 ->add(new Zend_Acl_Resource('admin::contest::featured-contest-details'), 'admin::admin');
		
		$this->allow('admin', 'admin::contest::contest-details')
			 ->allow('admin', 'admin::contest::match-details')
			 ->allow('admin', 'admin::contest::new-contest')
			 ->allow('admin', 'admin::contest::new-contest-type')                 
			 ->allow('admin', 'admin::contest::contest-type-details')                 
			 ->allow('admin', 'admin::contest::edit-contest')                 
			 ->allow('admin', 'admin::contest::edit-contest-type')
			 ->allow('admin', 'admin::contest::featured-contest')
			 ->allow('admin', 'admin::contest::get-contest')
			 ->allow('admin', 'admin::contest::featured-contest-details');
		
		$this->add(new Zend_Acl_Resource('admin::player'), 'admin')
			 ->add(new Zend_Acl_Resource('admin::player::player-details'), 'admin::admin')
			 ->add(new Zend_Acl_Resource('admin::player::player-stats'), 'admin::admin')
			 ->add(new Zend_Acl_Resource('admin::player::game-player'), 'admin::admin')
			 ->add(new Zend_Acl_Resource('admin::player::team-player-details'), 'admin::admin')
			 ->add(new Zend_Acl_Resource('admin::player::edit-disability'), 'admin::admin')
			 ->add(new Zend_Acl_Resource('admin::player::player-salary'), 'admin::admin');
		
		$this->allow('admin', 'admin::player::player-details')
			 ->allow('admin', 'admin::player::player-stats')
			 ->allow('admin', 'admin::player::game-player')
			 ->allow('admin', 'admin::player::team-player-details')
			 ->allow('admin', 'admin::player::edit-disability')
			 ->allow('admin', 'admin::player::player-salary');
		
		$this->add(new Zend_Acl_Resource('admin::settings'), 'admin')
			 ->add(new Zend_Acl_Resource('admin::settings::themes'), 'admin::admin')
			 ->add(new Zend_Acl_Resource('admin::settings::dashboard'), 'admin::admin')
			 ->add(new Zend_Acl_Resource('admin::settings::countries'), 'admin::admin')
			 ->add(new Zend_Acl_Resource('admin::settings::jshandler'), 'admin::admin')
			 ->add(new Zend_Acl_Resource('admin::settings::edit-country'), 'admin::admin')
			 ->add(new Zend_Acl_Resource('admin::settings::offers'), 'admin::admin')
			 ->add(new Zend_Acl_Resource('admin::settings::edit-offer'), 'admin::admin')
			 ->add(new Zend_Acl_Resource('admin::settings::bonus-country'), 'admin::admin')
			 ->add(new Zend_Acl_Resource('admin::settings::settings'), 'admin::admin')
			 ->add(new Zend_Acl_Resource('admin::settings::btc-address'), 'admin::admin')
			 ->add(new Zend_Acl_Resource('admin::settings::distribute-offers'), 'admin::admin');
		
		$this->allow('admin', 'admin::settings::themes')
			 ->allow('admin', 'admin::settings::dashboard')
			 ->allow('admin', 'admin::settings::countries')
			 ->allow('admin', 'admin::settings::jshandler')
			 ->allow('admin', 'admin::settings::edit-country')
			 ->allow('admin', 'admin::settings::offers')
			 ->allow('admin', 'admin::settings::edit-offer')
			 ->allow('admin', 'admin::settings::bonus-country')
			 ->allow('admin', 'admin::settings::settings')
			 ->allow('admin', 'admin::settings::btc-address')
			 ->allow('admin', 'admin::settings::distribute-offers');  
		
		 $this->add(new Zend_Acl_Resource('admin::store'), 'admin')
			  ->add(new Zend_Acl_Resource('admin::store::valid-tickets'), 'admin::admin')
			  ->add(new Zend_Acl_Resource('admin::store::edit-ticket'), 'admin::admin')
			  ->add(new Zend_Acl_Resource('admin::store::store'), 'admin::admin')
			  ->add(new Zend_Acl_Resource('admin::store::edit-product'), 'admin::admin')
			  ->add(new Zend_Acl_Resource('admin::store::new-ticket'), 'admin::admin')
			  ->add(new Zend_Acl_Resource('admin::store::ticket-handler'), 'admin::admin');
		 $this->allow('admin', 'admin::store::valid-tickets')
			  ->allow('admin', 'admin::store::edit-ticket')
			  ->allow('admin', 'admin::store::store')
			  ->allow('admin', 'admin::store::edit-product')
			  ->allow('admin', 'admin::store::new-ticket')
			  ->allow('admin', 'admin::store::ticket-handler');
		/**
		 * End admin Module
		 */
		
		/**
		 * User Module
		 */
		 
		$this->add(new Zend_Acl_Resource('user'))
			 ->add(new Zend_Acl_Resource('user::account'), 'user')
			 ->add(new Zend_Acl_Resource('user::account::account'), 'user::account')
			 ->add(new Zend_Acl_Resource('user::account::withdraw'), 'user::account')
			 ->add(new Zend_Acl_Resource('user::account::deposit-modal'), 'user::account')
			 ->add(new Zend_Acl_Resource('user::account::deposit'), 'user::account')
			 ->add(new Zend_Acl_Resource('user::account::block-user'), 'user::account')
			 ->add(new Zend_Acl_Resource('user::account::transaction'), 'user::account')
			 ->add(new Zend_Acl_Resource('user::account::billing'), 'user::account')
			 ->add(new Zend_Acl_Resource('user::account::add-user-address'), 'user::account')
			 ->add(new Zend_Acl_Resource('user::account::edit-user-address'), 'user::account')
			 ->add(new Zend_Acl_Resource('user::account::bonusoffers'), 'user::account')
			 ->add(new Zend_Acl_Resource('user::account::transaction-ajax-handler'), 'user::account')
			 ->add(new Zend_Acl_Resource('user::account::check-withdraw-ajax'), 'user::account')
	 ->add(new Zend_Acl_Resource('user::account::withdraw-ajax-handler'), 'user::account')
			 ->add(new Zend_Acl_Resource('user::account::ipn-listener'), 'user::account');
			 
		
		$this->allow('user', 'user::account::account')
			->allow('user', 'user::account::withdraw')
			->allow('user', 'user::account::deposit-modal')
			->allow('user', 'user::account::deposit')
			->allow('user', 'user::account::transaction')
			->allow('user', 'user::account::block-user')
			->allow('user', 'user::account::bonusoffers')
			->allow('user', 'user::account::billing')
			->allow('user', 'user::account::add-user-address')
			->allow('user', 'user::account::edit-user-address')
			->allow('user', 'user::account::transaction-ajax-handler')
			->allow('user', 'user::account::check-withdraw-ajax')
			->allow('user', 'user::account::withdraw-ajax-handler')
			->allow('guest', 'user::account::ipn-listener');
		
		
		$this->add(new Zend_Acl_Resource('user::lineup'), 'user')
			 ->add(new Zend_Acl_Resource('user::lineup::lineup'), 'user::lineup')
			 ->add(new Zend_Acl_Resource('user::lineup::lineuphandler'), 'user::lineup')
			 ->add(new Zend_Acl_Resource('user::lineup::create-lineup'), 'user::lineup')
			 ->add(new Zend_Acl_Resource('user::lineup::import-lineup'), 'user::lineup'); 
		
		$this->allow('user', 'user::lineup::lineup')
			 ->allow('user', 'user::lineup::lineuphandler')
			 ->allow('user', 'user::lineup::create-lineup')
			 ->allow('user', 'user::lineup::import-lineup');
		
		
		$this->add(new Zend_Acl_Resource('user::usercontest'), 'user')
			 ->add(new Zend_Acl_Resource('user::usercontest::contest'), 'user::usercontest')
			 ->add(new Zend_Acl_Resource('user::usercontest::usercontest-ajax-handler'), 'user::usercontest')
			 ->add(new Zend_Acl_Resource('user::usercontest::game-center'),'user::usercontest')
			 ->add(new Zend_Acl_Resource('user::usercontest::salary-cap'),'user::usercontest')
			 ->add(new Zend_Acl_Resource('user::usercontest::game-center-ajax'), 'user::usercontest'); 
		
		$this->allow('user', 'user::usercontest::contest')
			 ->allow('user', 'user::usercontest::usercontest-ajax-handler')
			 ->allow('user','user::usercontest::game-center')
			 ->allow('user','user::usercontest::salary-cap')
			 ->allow('user', 'user::usercontest::game-center-ajax');            
					
		$this->add(new Zend_Acl_Resource('user::notification'),'user')
			 ->add(new Zend_Acl_Resource('user::notification::add-notification'),'user::notification')
			 ->add(new Zend_Acl_Resource('user::notification::user-notification'),'user::notification')
			 ->add(new Zend_Acl_Resource('user::notification::user-read-notification'),'user::notification');
		$this->allow('user','user::notification::add-notification')
			 ->allow('user','user::notification::user-notification')
			 ->allow('user','user::notification::user-read-notification');
		/**
		 * End User Module
		 */
		
		/**
		 * Contest Module
		 */
		$this->add(new Zend_Acl_Resource('contest'))
			 ->add(new Zend_Acl_Resource('contest::contest'),'contest')
			 ->add(new Zend_Acl_Resource('contest::lineup'),'contest')
			 ->add(new Zend_Acl_Resource('contest::contest::draft-team'),'contest::contest')
			 ->add(new Zend_Acl_Resource('contest::contest::draft-team-lineup'),'contest::contest')
			 ->add(new Zend_Acl_Resource('contest::contest::filter-player-by-team'),'contest::contest')
			 ->add(new Zend_Acl_Resource('contest::lineup::player-stats'),'contest::lineup')
			 ->add(new Zend_Acl_Resource('contest::contest::direct-challenge'),'contest::contest')
			 ->add(new Zend_Acl_Resource('contest::contest::new-contest'),'contest::contest')
			 ->add(new Zend_Acl_Resource('contest::contest::new-lineup-contest'),'contest::contest')
			 ->add(new Zend_Acl_Resource('contest::contest::contest-ajax-handler'),'contest::contest')
			 ->add(new Zend_Acl_Resource('contest::contest::invite'),'contest::contest')
			 ->add(new Zend_Acl_Resource('contest::contest::invite-lineup'),'contest::contest')
			 ->add(new Zend_Acl_Resource('contest::contest::contest-details'),'contest::contest')
			 ->add(new Zend_Acl_Resource('contest::contest::deposit'),'contest::contest')
			 ->add(new Zend_Acl_Resource('contest::contest::new-lineup'),'contest::contest')
			 ->add(new Zend_Acl_Resource('contest::contest::edit-lineup'),'contest::contest')
			 ->add(new Zend_Acl_Resource('contest::contest::swap-lineup'),'contest::contest')
			 ->add(new Zend_Acl_Resource('contest::contest::edit-contest-lineup'),'contest::contest')
			 ->add(new Zend_Acl_Resource('contest::contest::create-challenge-ajax'),'contest::contest')
			 ->add(new Zend_Acl_Resource('contest::contest::swap-ajax-handler'),'contest::contest')
			 ->add(new Zend_Acl_Resource('contest::contest::depth-chart'),'contest::contest')
			 ->add(new Zend_Acl_Resource('contest::lineup::player-details'),'contest::contest');

		$this->allow('user','contest::contest::draft-team');
		$this->allow('user','contest::contest::draft-team-lineup');
		$this->allow('user','contest::contest::filter-player-by-team');
		$this->allow('user','contest::lineup::player-stats');
		$this->allow('user','contest::contest::direct-challenge');
		$this->allow('user','contest::contest::new-contest');
		$this->allow('user','contest::contest::new-lineup-contest');
		$this->allow('user','contest::contest::contest-ajax-handler');
		$this->allow('user','contest::contest::invite');
		$this->allow('user','contest::contest::invite-lineup');
		$this->allow('guest','contest::contest::contest-details');
		$this->allow('user','contest::contest::deposit');
		$this->allow('user','contest::contest::new-lineup');
		$this->allow('user','contest::contest::edit-lineup');
		$this->allow('user','contest::contest::swap-lineup');
		$this->allow('user','contest::contest::edit-contest-lineup');
		$this->allow('user','contest::contest::create-challenge-ajax');
		$this->allow('user','contest::contest::swap-ajax-handler');
		$this->allow('user','contest::contest::depth-chart');
		$this->allow('user','contest::lineup::player-details');

		/**
		 * End Contest Module
		 */
		
		
		/**
		 * Cron Module
		 */
		$this->add(new Zend_Acl_Resource('cron'))
			 ->add(new Zend_Acl_Resource('cron::cron'),'cron')
			 ->add(new Zend_Acl_Resource('cron::cron::players-stats'),'cron::cron')
			 ->add(new Zend_Acl_Resource('cron::cron::player-list'),'cron::cron')
			 ->add(new Zend_Acl_Resource('cron::cron::get-game-list'),'cron::cron')
			 ->add(new Zend_Acl_Resource('cron::cron::get-future-game-list'),'cron::cron')                 
			 ->add(new Zend_Acl_Resource('cron::cron::fetch-injured-players'),'cron::cron')
			 ->add(new Zend_Acl_Resource('cron::cron::contest-status-update'),'cron::cron')
			 ->add(new Zend_Acl_Resource('cron::cron::contest-result'),'cron::cron')
			 ->add(new Zend_Acl_Resource('cron::cron::check-match-status'),'cron::cron')
			 ->add(new Zend_Acl_Resource('cron::cron::dom-scraper'),'cron::cron')
			 ->add(new Zend_Acl_Resource('cron::cron::get-cancel-contest'),'cron::cron')
			 ->add(new Zend_Acl_Resource('cron::cron::notification-manager'),'cron::cron')
			 ->add(new Zend_Acl_Resource('cron::cron::registerd-emails'),'cron::cron')
			 ->add(new Zend_Acl_Resource('cron::cron::bot-players'),'cron::cron');
		  
			 
		$this->allow('guest','cron::cron::players-stats')
			 ->allow('guest','cron::cron::player-list')
			 ->allow('guest','cron::cron::get-game-list')
			 ->allow('guest','cron::cron::fetch-injured-players')
			 ->allow('guest','cron::cron::get-future-game-list')
			 ->allow('guest','cron::cron::contest-status-update')
			 ->allow('guest','cron::cron::contest-result')
			 ->allow('guest','cron::cron::check-match-status')
			 ->allow('guest','cron::cron::dom-scraper')
			 ->allow('guest','cron::cron::get-cancel-contest')
			 ->allow('guest','cron::cron::notification-manager')
			 ->allow('guest','cron::cron::registerd-emails')
			 ->allow('guest','cron::cron::bot-players');
	   /**
		 * End Corn Module
		 */            
		
		
		
		/**
		 * Static Module
		 */
		$this->add(new Zend_Acl_Resource('static'))
			 ->add(new Zend_Acl_Resource('static::static'),'static')
			 ->add(new Zend_Acl_Resource('static::static::contact-us'),'static::static')
			 ->add(new Zend_Acl_Resource('static::static::store'),'static::static')
			 ->add(new Zend_Acl_Resource('static::static::refer-friend'),'static::static')
			 ->add(new Zend_Acl_Resource('static::static::overview'),'static::static')
			 ->add(new Zend_Acl_Resource('static::static::store-ajax-handler'),'static::static')
			 ->add(new Zend_Acl_Resource('static::static::chat'),'static::static');
			 
		
		$this->allow('guest','static::static::contact-us')
			 ->allow('user','static::static::store')
			 ->allow('user','static::static::refer-friend')
			 ->allow('user','static::static::overview')
			 ->allow('user','static::static::chat')
			 ->allow('user','static::static::store-ajax-handler');
		/**
		 * End Static Module
		 */              
		

		/**
		 * Help Module
		 */
		$this->add(new Zend_Acl_Resource('help'))
			 ->add(new Zend_Acl_Resource('help::help'),'help')
			 ->add(new Zend_Acl_Resource('help::help::how-to-play'),'help::help')
			 ->add(new Zend_Acl_Resource('help::help::contest-rules'),'help::help')
			 ->add(new Zend_Acl_Resource('help::help::faq'),'help::help')
			 ->add(new Zend_Acl_Resource('help::help::contest-lobby'),'help::help')
			 ->add(new Zend_Acl_Resource('help::help::terms-of-use'),'help::help')
			 ->add(new Zend_Acl_Resource('help::help::privacy-notice'),'help::help')
			 ->add(new Zend_Acl_Resource('help::help::why-is-it-legel'),'help::help')
			 ->add(new Zend_Acl_Resource('help::help::affiliates'),'help::help')
			 ->add(new Zend_Acl_Resource('help::help::refer-a-friend'),'help::help')
			 ->add(new Zend_Acl_Resource('help::help::deposit'),'help::help')
			 ->add(new Zend_Acl_Resource('help::help::playbook'),'help::help')
			 ->add(new Zend_Acl_Resource('help::help::careers'),'help::help')
			 ->add(new Zend_Acl_Resource('help::help::about-us'),'help::help')
			 ->add(new Zend_Acl_Resource('help::help::why-draftoff'),'help::help')
			 ->add(new Zend_Acl_Resource('help::help::deposit-notice'),'help::help');
			 
			 
		$this->allow('guest','help::help::how-to-play')
			 ->allow('guest','help::help::contest-rules')
			 ->allow('guest','help::help::faq')
			 ->allow('guest','help::help::contest-lobby')
			 ->allow('guest','help::help::terms-of-use')
			 ->allow('guest','help::help::privacy-notice')
			 ->allow('guest','help::help::why-is-it-legel')
			 ->allow('guest','help::help::affiliates')
			 ->allow('guest','help::help::refer-a-friend')
			 ->allow('guest','help::help::deposit')
			 ->allow('guest','help::help::playbook')
			 ->allow('guest','help::help::careers')
			 ->allow('guest','help::help::about-us')
			 ->allow('guest','help::help::why-draftoff')
			 ->allow('guest','help::help::deposit-notice');
				
		/**
		 * End Help Module
		 */                  
		
		$this->add(new Zend_Acl_Resource('offer'))
			 ->add(new Zend_Acl_Resource('offer::offer'), 'offer')
			 ->add(new Zend_Acl_Resource('offer::offer::online-offer'), 'offer::offer')
			 ->add(new Zend_Acl_Resource('offer::offer::one-time-offer'), 'offer::offer')
			 ->add(new Zend_Acl_Resource('offer::offer::live-score'), 'offer::offer')
			 ->add(new Zend_Acl_Resource('offer::offer::export-ajax'), 'offer::offer');            
			 
		
		$this->allow('user', 'offer::offer::online-offer')
			 ->allow('user', 'offer::offer::one-time-offer')
			 ->allow('user', 'offer::offer::live-score')                 
			 ->allow('user', 'offer::offer::export-ajax');
			
		
		
		/**
		 * News Module
		 */
		$this->add(new Zend_Acl_Resource('news'))
			 ->add(new Zend_Acl_Resource('news::news'),'news')
			 ->add(new Zend_Acl_Resource('news::news::news-feed'),'news::news')
			 ->add(new Zend_Acl_Resource('news::news::new-lineup'),'news::news');
			 
		$this->allow('guest','news::news::news-feed')
			 ->allow('guest','news::news::new-lineup');
		/**
		 * End News Module
		 */              
	}
    
}

?>