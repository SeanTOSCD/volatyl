<?php
/** information.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * Information tab
 *
 * @package Volatyl
 * @since Volatyl 1.4
 */	
?>
<table class="form-table vol-information">
	<tr valign="top">
		<th scope="row" valign="top"><strong><?php printf(__('The %s Framework:', 'volatyl'), THEME_NAME); ?></strong></th>
		<td>
			<?php
				$vol_links = array(
					'Docs'	=> array(
						'name'	=> __('Documentation', 'volatyl'),
						'url'	=> 'http://volatylthemes.com/docs/'
					),
					'Support'	=> array(
						'name'	=> __('Support', 'volatyl'),
						'url'	=> 'http://volatylthemes.com/support/'
					),
					'Members'	=> array(
						'name'	=> __('Members Area', 'volatyl'),
						'url'	=> 'http://volatylthemes.com/members/'
					),
					'Affiliate'	=> array(
						'name'	=> __('Affiliate Program', 'volatyl'),
						'url'	=> 'http://volatylthemes.com/affiliates/'
					),
					'Skeletons'	=> array(
						'name'	=> __('Child Theme Skeletons', 'volatyl'),
						'url'	=> 'http://volatylthemes.com/skeletons-market/'
					),
				);
			?>
			<strong><?php echo __('Current version ', 'volatyl') . THEME_VERSION; ?></strong>
			<?php
				foreach ($vol_links as $vl) {
					printf(' &middot; <a href="%2$s" target="_blank"><strong>%1$s</strong></a>', $vl['name'], $vl['url']); 
				}
			?>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row" valign="top"><?php printf(__('The Creation of %s:', 'volatyl'), THEME_NAME); ?></th>
		<td>
			<p>
				<?php 
					printf(__('%1$s is an %2$s project created by Sean Davis and the wonderful WordPress Codex. Along the way, thanks to %3$s, email, and public begging on <strong>Austin, TX</strong> street corners, what you have here is a unique collection of concepts and codes to help you build websites with WordPress.</p>', 'volatyl'),
					THEME_NAME, 
					'<a href="http://sdavismedia.com/" target="_blank">SDavis Media</a>', 
					'<a href="http://sdvs.me/twitter" target="_blank">Twitter</a>');
				?>
			</p>
			<p>
				<?php
					printf(__('While there\'s no clear %s for the public begging, those who have taken the time to help solve coding problems, share their experiences, or provide encouragement deserve to be recognized. When you see these people around the universe, thank them.', 'volatyl'), 
					'<acronym title="Return on Investment" style="border-bottom: 1px dotted #ccc;">ROI</acronym>');
				?>
			</p>
			<p class="notes"><?php _e('Note: There were no core code contributors. Blame all of your bugs on Sean. ;)', 'volatyl'); ?></p>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row" valign="top"><?php _e('Special thanks to:', 'volatyl'); ?></th>
		<td>
		<?php
			$thanks_yo = array(
				'Andrew Norcross'	=> array(
					'name'			=> 'Andrew Norcross',
					'homepage_url'	=> 'http://andrewnorcross.com/',
					'twitter_url'	=> 'https://twitter.com/norcross/',
					'notes'			=> sprintf(__('Norcross probably sleeps on Twitter. Anytime a development issue was faced in the creation of %s, a simple tweet <em>always</em> led to his assistance. He reviewed code, suggested changes, offered solutions, and never asked for anything in return. Outstanding.', 'volatyl'), THEME_NAME)
				),
				'Alex Mangini'		=> array(
					'name'			=> 'Alex Mangini',
					'homepage_url'	=> 'http://kolakube.com/',
					'twitter_url'	=> 'https://twitter.com/afrais/',
					'notes'			=> sprintf(__('"The kid," as we like to call him, has backed %s from inception to launch. Many of the features that made the final cut were put through the ultimate "your friends will tell you the truth" test by Alex. His feedback and troubleshooting efforts are greatly appreciated.', 'volatyl'), THEME_NAME)
				),
				'Pippin Williamson'	=> array(
					'name'			=> 'Pippin Williamson',
					'homepage_url'	=> 'http://pippinsplugins.com/',
					'twitter_url'	=> 'https://twitter.com/pippinsplugins',
					'notes'			=> sprintf(__('Pippin is one of the most talented and hardworking developers I know. Not only was %1$s for Easy Digital Downloads built based on his work, but he also lends a helping hand when needed. Without his help, many aspects of %1$s wouldn&rsquo;t exist.', 'volatyl'), THEME_NAME)
				),
			);
			foreach ($thanks_yo as $ty) {
				printf('<a href="%2$s" target="_blank"><strong>%1$s</strong></a> &middot; 
				<a href="%3$s" target="_blank">Twitter</a><br><p>%4$s</p>',
					$ty['name'],
					esc_url($ty['homepage_url']),
					esc_url($ty['twitter_url']),
					$ty['notes']
				);
			}
		?>
		</td>
	</tr>
</table>