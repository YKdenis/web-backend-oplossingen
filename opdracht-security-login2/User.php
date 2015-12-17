<?php

	class User
	{

		public static function createNewUser( $connection, $email, $password )
		{
			$salt = uniqid(mt_rand(), true);

			$hashedPassword	=	hash( 'sha512', $salt . $password );

			$db = new Database( $connection );

			$query 	=	'INSERT INTO users
											(email,
											salt,
											hashed_password,
											last_login_time)
									VALUES (:email,
											:salt,
											:password,
											NOW())';
 
			// $tokens	=	array( ':email' => $email,
			// 					':salt' => $salt,
			// 					':password' => $hashedPassword);
 
			// $userData	=	$db->query( $query , $tokens );
			$preparedStatement = $connection->prepare($query);
 
			$preparedStatement->bindParam(':email', $email, \PDO::PARAM_STR);
			$preparedStatement->bindParam(':salt', $salt, \PDO::PARAM_STR);
			$preparedStatement->bindParam(':password', $hashedPassword, \PDO::PARAM_STR);
			$preparedStatement->execute();

			# TODO: Controle of user correct is toegevoegd
			# dmv query op database die laatste row van users ophaalt
			# en daaran controleert of deze user overeenstemt met de
			# user die zich wilde registreren

			$cookie 	= 	self::createCookie( $salt, $email );
			
			return $cookie;
		}

		public static function logout()
		{
			unset( $_SESSION['login'] );

			$unsetCookie 	=	setcookie( 'authenticated', '', 0 );

			return $unsetCookie;
		}

		public static function createCookie( $salt, $email )
		{
			// Cookie aanmaken
			$hashedEmail	=	hash( 'sha512', $salt . $email );
			$cookieValue	=	$email . ',' . $hashedEmail;

			$cookie	=	setcookie( 'authenticated', $cookieValue, time() + 3600 );

			return $cookie;
		}

		public static function validate( $connection )
		{

			if ( isset( $_COOKIE['authenticated'] ) )
			{
				
				$userData		=	explode( ',', $_COOKIE['authenticated'] );
				$email			= 	$userData[0];
				$saltedEmail	= 	$userData[1];

				$db = new Database( $connection );

				$userData	=	$db->query( 'SELECT * 
											FROM users 
											WHERE email = :email', 
										array(':email' => $email ) );

				if( isset( $userData['data'][0] ) )
				{
					$salt = $userData['data'][0]['salt'];

					$newlySaltedEmail 	= hash( 'sha512' , $salt . $email );

					if ( $newlySaltedEmail == $saltedEmail )
					{
						# Cookie is correct
						return true;
					}
					else
					{
						# Password niet correct
						return false;
					}
				}
				else
				{
					# User niet gevonden
					return false;
				}
			}
			else
			{
				#Cookie niet geset
				return false;
			}

		}

	}

?>