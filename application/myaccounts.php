<?php /*
	Copyright 2014-2017 Cédric Levieux, Jérémy Collot, ArmagNet

	This file is part of OpenTweetBar.

    OpenTweetBar is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    OpenTweetBar is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with OpenTweetBar.  If not, see <http://www.gnu.org/licenses/>.
*/
include_once("header.php");

$accounts = $accountBo->getAdministratedAccounts($userId);

foreach($accounts as $key => $account) {
	$accounts[$key]["administrators"] = $accountBo->getAccountAdministrators($account["sna_id"]);
	$accounts[$key]["validatorGroups"] = $accountBo->getValidators($account["sna_id"]);
}
?>
<div class="container theme-showcase" role="main">
	<ol class="breadcrumb">
		<li><a href="index.php"><?php echo lang("breadcrumb_index"); ?> </a></li>
		<?php 	if ($user) {?>
		<li><a href="mypage.php"><?php echo $user; ?></a></li>
		<?php 	}?>
		<li class="active"><?php echo lang("breadcrumb_myaccounts"); ?></li>
	</ol>

	<div class="well well-sm">
		<p>
			<?php echo lang("myaccounts_guide"); ?>
		</p>
	</div>

	<?php 	if ($user) {?>

	<div id="configurationTabs" role="tabpanel">

		<!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#new" aria-controls="new" role="tab" data-toggle="tab">Nouveau compte</a></li>
			<?php foreach($accounts as $account) {?>
			<li role="presentation"><a href="#<?php echo $account["sna_name"]; ?>" aria-controls="<?php echo $account["sna_name"]; ?>" role="tab" data-toggle="tab"><?php echo $account["sna_name"]; ?></a></li>
			<?php }?>
		</ul>

		<!-- Tab panes -->
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="new">

				<form class="form-horizontal">
					<fieldset>

						<legend>
							<?php echo lang("myaccounts_newaccount_form_legend"); ?>
						</legend>

						<input type="hidden" name="accountIdInput" id="accountIdInput" value="0"/>


						<div class="form-group">
							<label class="col-md-4 control-label" for="nameInput"><?php echo lang("myaccounts_account_form_nameInput"); ?></label>
							<div class="col-md-6">
								<input id="nameInput" name="nameInput" value="" type="text"
									placeholder="" class="form-control input-md">
							</div>
						</div>


						<div class="form-group">
							<div class="col-md-4 control-label">
								<input id="anonymousInput" name="anonymousInput" value="cgv" type="checkbox"
									placeholder="" class="input-md">
							</div>
							<div class="col-md-6">
								<label class="form-control labelForCheckbox" for="anonymousInput"><?php echo lang("myaccounts_account_form_anonymousPermitted"); ?> </label>
							</div>
						</div>


						<div class="form-group">
							<label class="col-md-4 control-label" for="anonymousPasswordInput"><?php echo lang("myaccounts_account_form_anonymousPasswordInput"); ?></label>
							<div class="col-md-6">
								<input id="anonymousPasswordInput" name="anonymousPasswordInput" value="" type="text"
									placeholder="" class="form-control input-md" disabled="disabled">
							</div>
						</div>


						<div class="form-group">
							<label class="col-md-4 control-label" for="validationScoreInput"><?php echo lang("myaccounts_account_form_validationScoreInput"); ?></label>
							<div class="col-md-6">
								<input id="validationScoreInput" name="validationScoreInput" value="" type="text"
									placeholder="" class="form-control input-md">
							</div>
						</div>

						<legend>
							<?php echo lang("myaccounts_twitter_form_legend"); ?>
						</legend>


						<div class="form-group">
							<label class="col-md-4 control-label" for="apiKeyInput"><?php echo lang("myaccounts_twitter_form_apiKeyInput"); ?></label>
							<div class="col-md-6">
								<input id="apiKeyInput" name="apiKeyInput" value="" type="text"
									placeholder="" class="form-control input-md">
							</div>
						</div>


						<div class="form-group">
							<label class="col-md-4 control-label" for="apiSecretInput"><?php echo lang("myaccounts_twitter_form_apiSecretInput"); ?></label>
							<div class="col-md-6">
								<input id="apiSecretInput" name="apiSecretInput" value="" type="text"
									placeholder="" class="form-control input-md">
							</div>
						</div>


						<div class="form-group">
							<label class="col-md-4 control-label" for="accessTokenInput"><?php echo lang("myaccounts_twitter_form_accessTokenInput"); ?></label>
							<div class="col-md-6">
								<input id="accessTokenInput" name="accessTokenInput" value="" type="text"
									placeholder="" class="form-control input-md">
							</div>
						</div>


						<div class="form-group">
							<label class="col-md-4 control-label" for="accessTokenSecretInput"><?php echo lang("myaccounts_twitter_form_accessTokenSecretInput"); ?></label>
							<div class="col-md-6">
								<input id="accessTokenSecretInput" name="accessTokenSecretInput" value="" type="text"
									placeholder="" class="form-control input-md">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label" for="testTweeterButton"></label>
							<div class="col-md-8">
								<button id="testTweeterButton" name="testTweeterButton" class="testTweeterButton btn btn-primary"><?php echo lang("myaccount_button_testTwitter"); ?></button>
							</div>
						</div>

						<?php echo addAlertDialog("ok_twitter_successAlert", lang("ok_twitter_success"), "success"); ?>
						<?php echo addAlertDialog("error_twitter_cant_authenticateAlert", lang("error_twitter_cant_authenticate"), "danger"); ?>

						<legend>
							<?php echo lang("myaccounts_facebook_page_form_legend"); ?>
						</legend>

						<div class="form-group">
							<label class="col-md-4 control-label" for="pageIdInput"><?php echo lang("myaccounts_facebook_page_form_pageIdInput"); ?></label>
							<div class="col-md-6">
								<input id="pageIdInput" name="pageIdInput" value="" type="text"
									placeholder="" class="form-control input-md">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label" for="fpAccessTokenInput"><?php echo lang("myaccounts_facebook_page_form_fpAccessTokenInput"); ?></label>
							<div class="col-md-6">
								<div class="input-group">
									<input id="fpAccessTokenInput" name="fpAccessTokenInput" value="" type="text"
										placeholder="" class="form-control input-md">
									<span class="input-group-btn">
										<button type="button" class="toggle-create-access-token btn btn-default">
											<span class="glyphicon glyphicon-plus"></span>
										</button>
									</span>
								</div>
							</div>
						</div>

						<div class="form-group create-access-token">
							<label class="col-md-4 control-label" for="applicationIdInput"><?php echo lang("myaccounts_facebook_page_form_applicationIdInput"); ?></label>
							<div class="col-md-6">
								<input id="applicationIdInput" name="applicationIdInput" value="" type="text"
									placeholder="" class="form-control input-md">
							</div>
						</div>

						<div class="form-group create-access-token">
							<label class="col-md-4 control-label" for="applicationSecretKeyInput"><?php echo lang("myaccounts_facebook_page_form_applicationSecretKeyInput"); ?></label>
							<div class="col-md-6">
								<input id="applicationSecretKeyInput" name="applicationSecretKeyInput" value="" type="text"
									placeholder="" class="form-control input-md">
							</div>
						</div>

						<div class="form-group create-access-token">
							<label class="col-md-4 control-label" for="shortLiveUserAccessTokenInput"><?php echo lang("myaccounts_facebook_page_form_shortLiveUserAccessTokenInput"); ?></label>
							<div class="col-md-6">
								<input id="shortLiveUserAccessTokenInput" name="shortLiveUserAccessTokenInput" value="" type="text"
									placeholder="" class="form-control input-md">
							</div>
						</div>

						<div class="form-group create-access-token">
							<label class="col-md-4 control-label" for="createFacebookPageAccessTokenButton"></label>
							<div class="col-md-8">
								<button id="createFacebookPageAccessTokenButton" name="createFacebookPageAccessTokenButton" class="createFacebookPageAccessTokenButton btn btn-primary"><?php echo lang("myaccounts_facebook_page_form_createFacebookPageAccessTokenButton"); ?></button>
							</div>
						</div>

						<legend>
							<?php echo lang("myaccounts_mastodon_form_legend"); ?>
						</legend>


						<div class="form-group">
							<label class="col-md-4 control-label" for="mstdUrlInput"><?php echo lang("myaccounts_mastodon_form_mstdUrlInput"); ?></label>
							<div class="col-md-6">
								<input id="mstdUrlInput" name="mstdUrlInput" value="" type="text"
									placeholder="" class="form-control input-md">
							</div>
						</div>


						<div class="form-group">
							<label class="col-md-4 control-label" for="mstdClientNameInput"><?php echo lang("myaccounts_mastodon_form_mstdClientNameInput"); ?></label>
							<div class="col-md-6">
								<input id="mstdClientNameInput" name="mstdClientNameInput" value="OpenTweetBar Mastodon Client" type="text"
									placeholder="" class="form-control input-md">
							</div>
						</div>


						<div class="form-group">
							<label class="col-md-4 control-label" for="mstdEmailInput"><?php echo lang("myaccounts_mastodon_form_mstdEmailInput"); ?></label>
							<div class="col-md-6">
								<input id="mstdEmailInput" name="mstdEmailInput" value="" type="text"
									placeholder="" class="form-control input-md">
							</div>
						</div>


						<div class="form-group">
							<label class="col-md-4 control-label" for="mstdPasswordInput"><?php echo lang("myaccounts_mastodon_form_mstdPasswordInput"); ?></label>
							<div class="col-md-6">
								<input id="mstdPasswordInput" name="mstdPasswordInput" value="" type="password"
									placeholder="" class="form-control input-md">
							</div>
						</div>


						<div class="form-group">
							<label class="col-md-4 control-label" for="createMastodonAccessButton"></label>
							<div class="col-md-8">
								<button id="createMastodonAccessButton" name="createMastodonAccessButton" 
									class="createMastodonAccessButton btn btn-primary"><?php echo lang("myaccount_button_createMastodonAccess"); ?></button>
							</div>
						</div>


						<div class="form-group">
							<label class="col-md-4 control-label" for="mstdClientIdInput"><?php echo lang("myaccounts_mastodon_form_mstdClientIdInput"); ?></label>
							<div class="col-md-6">
								<input id="mstdClientIdInput" name="mstdClientIdInput" value="" type="text"
									placeholder="" class="form-control input-md">
							</div>
						</div>


						<div class="form-group">
							<label class="col-md-4 control-label" for="mstdClientSecretInput"><?php echo lang("myaccounts_mastodon_form_mstdClientSecretInput"); ?></label>
							<div class="col-md-6">
								<input id="mstdClientSecretInput" name="mstdClientSecretInput" value="" type="text"
									placeholder="" class="form-control input-md">
							</div>
						</div>


						<div class="form-group">
							<label class="col-md-4 control-label" for="mstdUserTokenInput"><?php echo lang("myaccounts_mastodon_form_mstdUserTokenInput"); ?></label>
							<div class="col-md-6">
								<input id="mstdUserTokenInput" name="mstdUserTokenInput" value="" type="text"
									placeholder="" class="form-control input-md">
							</div>
						</div>

<!-- 
						<div class="form-group">
							<label class="col-md-4 control-label" for="mstdUrlInput"><?php echo lang("myaccounts_mastodon_form_mstdUrlInput"); ?></label>
							<div class="col-md-6">
								<input id="mstdUrlInput" name="mstdUrlInput" value="" type="text"
									placeholder="" class="form-control input-md">
							</div>
						</div>
 -->
 						<input id="mstdTokenTypeInput" name="mstdTokenTypeInput" value="bearer" type="hidden">
 
						<div class="form-group">
							<label class="col-md-4 control-label" for="testMastodonButton"></label>
							<div class="col-md-8">
								<button id="testMastodonButton" name="testMastodonButton" class="testMastodonButton btn btn-primary"><?php echo lang("myaccount_button_testMastodon"); ?></button>
							</div>
						</div>

						<?php echo addAlertDialog("ok_mastodon_successAlert", lang("ok_mastodon_success"), "success"); ?>
						<?php echo addAlertDialog("error_mastodon_cant_authenticateAlert", lang("error_mastodon_cant_authenticate"), "danger"); ?>

						<legend>
							<?php echo lang("myaccounts_administrators_form_legend"); ?>
						</legend>

						<div class="form-group">
							<label class="col-md-4 control-label" for="addUserInput"><?php echo lang("myaccounts_administrators_form_addUserInput"); ?> </label>
							<div class="col-md-6">
								<div class="input-group">
									<input
										id="addUserInput" name="addUserInput" value="" type="text" placeholder="" class="form-control input-md typeahead"
											data-provide="typeahead" data-items="4" data-soure=''>
									<span class="input-group-btn">
										<button type="button" class="addUserButton btn btn-default">
											<span class="glyphicon glyphicon-plus"></span>
										</button>
									</span>
								</div>
								<p class="btn-group administrators"><span style="margin-right:5px; " class="label label-default"><?php echo $user;?><input type="hidden" class="administratorId" value="<?php echo $userId; ?>" /><span style="margin-left:5px; " class="glyphicon glyphicon-remove"></span></span></p>
							</div>
						</div>

						<legend>
							<?php echo lang("myaccounts_validators_form_legend"); ?>
						</legend>


						<div class="form-group addGroupDiv">
							<label class="col-md-4 control-label" for="addGroupButton"></label>
							<div class="col-md-8">
								<button id="addGroupButton" name="addGroupButton" class="addGroupButton btn btn-success"><?php echo lang("myaccounts_validators_form_addGroupInput"); ?></button>
							</div>
						</div>

						<hr />


						<div class="form-group">
							<label class="col-md-4 control-label" for="saveAccountButton"></label>
							<div class="col-md-8">
								<button id="saveAccountButton" name="saveAccountButton" class="saveAccountButton btn btn-default"><?php echo lang("myaccount_add"); ?></button>
							</div>
						</div>

					</fieldset>
				</form>

			</div>
			<?php foreach($accounts as $account) {?>
			<div role="tabpanel" class="tab-pane" id="<?php echo $account["sna_name"]; ?>">

				<form class="form-horizontal">
					<fieldset>

						<legend>
							<?php echo str_replace("{account}", $account["sna_name"], lang("myaccounts_existingaccount_form_legend")); ?>
						</legend>

						<input type="hidden" name="accountIdInput" id="accountIdInput" value="<?php echo $account["sna_id"]; ?>"/>


						<div class="form-group">
							<label class="col-md-4 control-label" for="nameInput"><?php echo lang("myaccounts_account_form_nameInput"); ?></label>
							<div class="col-md-6">
								<input id="nameInput" name="nameInput" value="<?php echo @$account["sna_name"];?>" type="text"
									placeholder="" class="form-control input-md">
							</div>
						</div>


						<div class="form-group">
							<div class="col-md-4 control-label">
								<input id="anonymousInput" name="anonymousInput" value="1" type="checkbox"
									placeholder="" class="input-md" <?php if (@$account["sco_anonymous_permitted"]) { echo 'checked="checked"'; }?>>
							</div>
							<div class="col-md-6">
								<label class="form-control labelForCheckbox" for="anonymousInput"><?php echo lang("myaccounts_account_form_anonymousPermitted"); ?> </label>
							</div>
						</div>


						<div class="form-group">
							<label class="col-md-4 control-label" for="anonymousPasswordInput"><?php echo lang("myaccounts_account_form_anonymousPasswordInput"); ?></label>
							<div class="col-md-6">
								<input id="anonymousPasswordInput" name="anonymousPasswordInput" value="<?php echo @$account["sco_anonymous_password"];?>" type="text"
									placeholder="" class="form-control input-md" <?php if (!@$account["sco_anonymous_permitted"]) { echo 'disabled="disabled"'; }?> >
							</div>
						</div>


						<div class="form-group">
							<label class="col-md-4 control-label" for="validationScoreInput"><?php echo lang("myaccounts_account_form_validationScoreInput"); ?></label>
							<div class="col-md-6">
								<input id="validationScoreInput" name="validationScoreInput" value="<?php echo @$account["sco_validation_score"];?>" type="text"
									placeholder="" class="form-control input-md">
							</div>
						</div>

						<legend>
							<?php echo lang("myaccounts_twitter_form_legend"); ?>
						</legend>


						<div class="form-group">
							<label class="col-md-4 control-label" for="apiKeyInput"><?php echo lang("myaccounts_twitter_form_apiKeyInput"); ?></label>
							<div class="col-md-6">
								<input id="apiKeyInput" name="apiKeyInput" value="<?php echo @$account["stc_api_key"];?>" type="text"
									placeholder="" class="form-control input-md">
							</div>
						</div>


						<div class="form-group">
							<label class="col-md-4 control-label" for="apiSecretInput"><?php echo lang("myaccounts_twitter_form_apiSecretInput"); ?></label>
							<div class="col-md-6">
								<input id="apiSecretInput" name="apiSecretInput" value="<?php echo @$account["stc_api_secret"];?>" type="text"
									placeholder="" class="form-control input-md">
							</div>
						</div>


						<div class="form-group">
							<label class="col-md-4 control-label" for="accessTokenInput"><?php echo lang("myaccounts_twitter_form_accessTokenInput"); ?></label>
							<div class="col-md-6">
								<input id="accessTokenInput" name="accessTokenInput" value="<?php echo @$account["stc_access_token"];?>" type="text"
									placeholder="" class="form-control input-md">
							</div>
						</div>


						<div class="form-group">
							<label class="col-md-4 control-label" for="accessTokenSecretInput"><?php echo lang("myaccounts_twitter_form_accessTokenSecretInput"); ?></label>
							<div class="col-md-6">
								<input id="accessTokenSecretInput" name="accessTokenSecretInput" value="<?php echo @$account["stc_access_token_secret"];?>" type="text"
									placeholder="" class="form-control input-md">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label" for="testTweeterButton"></label>
							<div class="col-md-8">
								<button id="testTweeterButton" name="testTweeterButton" class="testTweeterButton btn btn-primary"><?php echo lang("myaccount_button_testTwitter"); ?></button>
							</div>
						</div>

						<?php echo addAlertDialog("ok_twitter_successAlert", lang("ok_twitter_success"), "success"); ?>
						<?php echo addAlertDialog("error_twitter_cant_authenticateAlert", lang("error_twitter_cant_authenticate"), "danger"); ?>

						<legend>
							<?php echo lang("myaccounts_facebook_page_form_legend"); ?>
						</legend>

						<div class="form-group">
							<label class="col-md-4 control-label" for="pageIdInput"><?php echo lang("myaccounts_facebook_page_form_pageIdInput"); ?></label>
							<div class="col-md-6">
								<input id="pageIdInput" name="pageIdInput" value="<?php echo @$account["sfp_page_id"];?>" type="text"
									placeholder="" class="form-control input-md">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label" for="fpAccessTokenInput"><?php echo lang("myaccounts_facebook_page_form_fpAccessTokenInput"); ?></label>
							<div class="col-md-6">
								<div class="input-group">
									<input id="fpAccessTokenInput" name="fpAccessTokenInput" value="<?php echo @$account["sfp_access_token"];?>" type="text"
										placeholder="" class="form-control input-md">
									<span class="input-group-btn">
										<button type="button" class="toggle-create-access-token btn btn-default">
											<span class="glyphicon glyphicon-plus"></span>
										</button>
									</span>
								</div>
							</div>
						</div>

						<div class="form-group create-access-token">
							<label class="col-md-4 control-label" for="applicationIdInput"><?php echo lang("myaccounts_facebook_page_form_applicationIdInput"); ?></label>
							<div class="col-md-6">
								<input id="applicationIdInput" name="applicationIdInput" value="" type="text"
									placeholder="" class="form-control input-md">
							</div>
						</div>

						<div class="form-group create-access-token">
							<label class="col-md-4 control-label" for="applicationSecretKeyInput"><?php echo lang("myaccounts_facebook_page_form_applicationSecretKeyInput"); ?></label>
							<div class="col-md-6">
								<input id="applicationSecretKeyInput" name="applicationSecretKeyInput" value="" type="text"
									placeholder="" class="form-control input-md">
							</div>
						</div>

						<div class="form-group create-access-token">
							<label class="col-md-4 control-label" for="shortLiveUserAccessTokenInput"><?php echo lang("myaccounts_facebook_page_form_shortLiveUserAccessTokenInput"); ?></label>
							<div class="col-md-6">
								<input id="shortLiveUserAccessTokenInput" name="shortLiveUserAccessTokenInput" value="" type="text"
									placeholder="" class="form-control input-md">
							</div>
						</div>

						<div class="form-group create-access-token">
							<label class="col-md-4 control-label" for="createFacebookPageAccessTokenButton"></label>
							<div class="col-md-8">
								<button id="createFacebookPageAccessTokenButton" name="createFacebookPageAccessTokenButton" class="createFacebookPageAccessTokenButton btn btn-primary"><?php echo lang("myaccounts_facebook_page_form_createFacebookPageAccessTokenButton"); ?></button>
							</div>
						</div>

<!-- TODO
						<div class="form-group">
							<label class="col-md-4 control-label" for="testTweeterButton"></label>
							<div class="col-md-8">
								<button id="testTweeterButton" name="testTweeterButton" class="testTweeterButton btn btn-primary"><?php echo lang("myaccount_button_testTwitter"); ?></button>
							</div>
						</div>
-->
						<?php echo addAlertDialog("ok_facebook_page_successAlert", lang("ok_facebook_page_success"), "success"); ?>
						<?php echo addAlertDialog("error_facebook_page_cant_authenticateAlert", lang("error_facebook_page_cant_authenticate"), "danger"); ?>

						<legend>
							<?php echo lang("myaccounts_mastodon_form_legend"); ?>
						</legend>


						<div class="form-group">
							<label class="col-md-4 control-label" for="mstdUrlInput"><?php echo lang("myaccounts_mastodon_form_mstdUrlInput"); ?></label>
							<div class="col-md-6">
								<input id="mstdUrlInput" name="mstdUrlInput" value="<?php echo @$account["smc_url"];?>" type="text"
									placeholder="" class="form-control input-md">
							</div>
						</div>


						<div class="form-group">
							<label class="col-md-4 control-label" for="mstdClientNameInput"><?php echo lang("myaccounts_mastodon_form_mstdClientNameInput"); ?></label>
							<div class="col-md-6">
								<input id="mstdClientNameInput" name="mstdClientNameInput" value="<?php echo @$account["smc_client_name"];?>" type="text"
									placeholder="" class="form-control input-md">
							</div>
						</div>


						<div class="form-group">
							<label class="col-md-4 control-label" for="mstdEmailInput"><?php echo lang("myaccounts_mastodon_form_mstdEmailInput"); ?></label>
							<div class="col-md-6">
								<input id="mstdEmailInput" name="mstdEmailInput" value="" type="text"
									placeholder="" class="form-control input-md">
							</div>
						</div>


						<div class="form-group">
							<label class="col-md-4 control-label" for="mstdPasswordInput"><?php echo lang("myaccounts_mastodon_form_mstdPasswordInput"); ?></label>
							<div class="col-md-6">
								<input id="mstdPasswordInput" name="mstdPasswordInput" value="" type="password"
									placeholder="" class="form-control input-md">
							</div>
						</div>


						<div class="form-group">
							<label class="col-md-4 control-label" for="createMastodonAccessButton"></label>
							<div class="col-md-8">
								<button id="createMastodonAccessButton" name="createMastodonAccessButton" 
									class="createMastodonAccessButton btn btn-primary"><?php echo lang("myaccount_button_createMastodonAccess"); ?></button>
							</div>
						</div>


						<div class="form-group">
							<label class="col-md-4 control-label" for="mstdClientIdInput"><?php echo lang("myaccounts_mastodon_form_mstdClientIdInput"); ?></label>
							<div class="col-md-6">
								<input id="mstdClientIdInput" name="mstdClientIdInput" value="<?php echo @$account["smc_client_id"];?>" type="text"
									placeholder="" class="form-control input-md">
							</div>
						</div>


						<div class="form-group">
							<label class="col-md-4 control-label" for="mstdClientSecretInput"><?php echo lang("myaccounts_mastodon_form_mstdClientSecretInput"); ?></label>
							<div class="col-md-6">
								<input id="mstdClientSecretInput" name="mstdClientSecretInput" value="<?php echo @$account["smc_client_secret"];?>" type="text"
									placeholder="" class="form-control input-md">
							</div>
						</div>


						<div class="form-group">
							<label class="col-md-4 control-label" for="mstdUserTokenInput"><?php echo lang("myaccounts_mastodon_form_mstdUserTokenInput"); ?></label>
							<div class="col-md-6">
								<input id="mstdUserTokenInput" name="mstdUserTokenInput" value="<?php echo @$account["smc_user_token"];?>" type="text"
									placeholder="" class="form-control input-md">
							</div>
						</div>

<!-- 
						<div class="form-group">
							<label class="col-md-4 control-label" for="mstdUrlInput"><?php echo lang("myaccounts_mastodon_form_mstdUrlInput"); ?></label>
							<div class="col-md-6">
								<input id="mstdUrlInput" name="mstdUrlInput" value="" type="text"
									placeholder="" class="form-control input-md">
							</div>
						</div>
 -->
 						<input id="mstdTokenTypeInput" name="mstdTokenTypeInput" value="bearer" type="hidden">

						<div class="form-group">
							<label class="col-md-4 control-label" for="testMastodonButton"></label>
							<div class="col-md-8">
								<button id="testMastodonButton" name="testMastodonButton" class="testMastodonButton btn btn-primary"><?php echo lang("myaccount_button_testMastodon"); ?></button>
							</div>
						</div>

						<?php echo addAlertDialog("ok_mastodon_successAlert", lang("ok_mastodon_success"), "success"); ?>
						<?php echo addAlertDialog("error_mastodon_cant_authenticateAlert", lang("error_mastodon_cant_authenticate"), "danger"); ?>

						<legend>
							<?php echo lang("myaccounts_administrators_form_legend"); ?>
						</legend>

						<div class="form-group">
							<label class="col-md-4 control-label" for="addUserInput"><?php echo lang("myaccounts_administrators_form_addUserInput"); ?> </label>
							<div class="col-md-6">
								<div class="input-group">
									<input
										id="addUserInput" name="addUserInput" value="" type="text" placeholder="" class="form-control input-md typeahead"
											data-provide="typeahead" data-items="4" data-soure=''>
									<span class="input-group-btn">
										<button type="button" class="addUserButton btn btn-default">
											<span class="glyphicon glyphicon-plus"></span>
										</button>
									</span>
								</div>
								<p class="btn-group administrators">
									<?php foreach($account["administrators"] as $administrator) {?>
									<span style="margin-right:5px; " class="label label-default"><input type="hidden" class="administratorId" value="<?php echo $administrator["use_id"]; ?>" /><?php echo $administrator["use_login"]; ?><span style="margin-left:5px; " class="glyphicon glyphicon-remove"></span></span>
									<?php }?>
								</p>
							</div>
						</div>

						<legend>
							<?php echo lang("myaccounts_validators_form_legend"); ?>
						</legend>

						<?php foreach($account["validatorGroups"] as $validatorGroup) {?>

					<div class="validatorGroup">

						<div class="form-group">
							<label class="col-md-4 control-label" for="nameInput"><?php echo lang("myaccounts_validators_form_groupNameInput"); ?></label>
							<div class="col-md-6">
								<input id="nameInput" name="nameInput" value="<?php echo $validatorGroup["vgr_name"];?>" type="text"
									placeholder="" class="form-control input-md">
							</div>
						</div>


						<div class="form-group">
							<label class="col-md-4 control-label" for="scoreInput"><?php echo lang("myaccounts_validators_form_groupScoreInput"); ?></label>
							<div class="col-md-2">
								<input id="scoreInput" name="scoreInput" value="<?php echo $validatorGroup["vgr_score"];?>" type="text"
									placeholder="" class="form-control input-md">
							</div>
							<label class="col-md-4 control-label" for="timelineInput"><?php echo lang("myaccounts_validators_form_groupShowInTimeline"); ?></label>
							<div class="col-md-2">
								<input id="timelineInput" name="timelineInput" value="1" <?php if ($validatorGroup["vgr_show_timeline"] == "1") echo "checked='checked'"; ?>" type="checkbox"
									placeholder="" class="form-control input-md">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label" for="addValidatorInput"><?php echo lang("myaccounts_validators_form_addUserInput"); ?></label>
							<div class="col-md-6">
								<div class="input-group">
									<input
										id="addValidatorInput" name="addValidatorInput" value="" type="text" placeholder="" class="form-control input-md typeahead"
											data-provide="typeahead" data-items="4" data-soure=''>
									<span class="input-group-btn">
										<button type="button" class="addValidatorButton btn btn-default">
											<span class="glyphicon glyphicon-plus"></span>
										</button>
									</span>
								</div>
								<p class="btn-group validators">
									<?php foreach($validatorGroup["validators"] as $validator) {?>
									<span style="margin-right:5px; " class="label label-default"><input type="hidden" class="validatorId" value="<?php echo $validator["use_id"]; ?>" /><?php echo $validator["use_login"]; ?><span style="margin-left:5px; " class="glyphicon glyphicon-remove"></span></span>
									<?php }?>
								</p>
							</div>
						</div>


						<div class="form-group">
							<label class="col-md-4 control-label" for="deleteGroupButton"></label>
							<div class="col-md-8">
								<button id="deleteGroupButton" name="deleteGroupButton" class="deleteGroupButton btn btn-danger"><?php echo lang("myaccounts_validators_form_deleteGroupInput"); ?></button>
							</div>
						</div>

						<hr />
					</div>

						<?php }?>


						<div class="form-group addGroupDiv">
							<label class="col-md-4 control-label" for="addGroupButton"></label>
							<div class="col-md-8">
								<button id="addGroupButton" name="addGroupButton" class="addGroupButton btn btn-success"><?php echo lang("myaccounts_validators_form_addGroupInput"); ?></button>
							</div>
						</div>

						<hr />


						<div class="form-group">
							<label class="col-md-4 control-label" for="saveAccountButton"></label>
							<div class="col-md-8">
								<button id="saveAccountButton" name="saveAccountButton" class="saveAccountButton btn btn-default"><?php echo lang("myaccount_save"); ?></button>
							</div>
						</div>

					</fieldset>
				</form>

			</div>
			<?php }?>
		</div>
	</div>

	<?php echo addAlertDialog("ok_operation_successAlert", lang("ok_operation_success"), "success"); ?>

	<?php 	} else {
		include("connectButton.php");
	}?>

</div>

<div class="lastDiv"></div>

<?php include("footer.php");?>
<script>

function responseHandler(data) {
//	debugger;
	
	if (data.ok) {
		$("#ok_operation_successAlert").show().delay(2000).fadeOut(1000);
		window.location.reload(true);
	}
	else {
		$("#" + data.message + "Alert").show().delay(2000).fadeOut(1000);
	}
}

function administratorClickHandler() {
	if ($(this).parents("form").find(".administrators .label").length > 1) {
		$(this).remove();
	}
}

function validatorClickHandler() {
	$(this).remove();
}

function deleteGroupClickHandler(event) {
	event.preventDefault();
	$(this).parents(".validatorGroup").remove();
}

function addValidatorHandler(event) {
	event.preventDefault();
	var button = $(this);
	var user = button.parent("span").siblings("input").val();

	$.post("do_getUserId.php", {"user": user}, function(data) {
		if (data.id) {
			var userLabel = "<span style=\"margin-right:5px; \" class=\"label label-default\">";
			userLabel += user;
			userLabel += "<input type=\"hidden\" class=\"validatorId\" value=\"" + data.id + "\" />";
			userLabel += "<span style=\"margin-left:5px; \" class=\"glyphicon glyphicon-remove\"></span></span>";
			userLabel = $(userLabel);

			userLabel.click(validatorClickHandler);

			button.parent("span").siblings("input").val("");
			button.parents(".validatorGroup").find(".validators").append(userLabel);
		}
	}, "json");
}

$(function() {
	$(".administrators .label").click(administratorClickHandler);
	$(".validators .label").click(validatorClickHandler);
	$(".deleteGroupButton").click(deleteGroupClickHandler);

	$(".addValidatorButton").click(addValidatorHandler);

	$(".addGroupButton").click(function(event) {
		event.preventDefault();

		var html = "";
		html += "<div class=\"validatorGroup\">";
		html += "<div class=\"form-group\">";
		html += "	<label class=\"col-md-4 control-label\" for=\"nameInput\"><?php echo lang("myaccounts_validators_form_groupNameInput"); ?></label>";
		html += "	<div class=\"col-md-6\">";
		html += "		<input id=\"nameInput\" name=\"nameInput\" value=\"\" type=\"text\"";
		html += "			placeholder=\"\" class=\"form-control input-md\">";
		html += "	</div>";
		html += "</div>";

		html += "<div class=\"form-group\">";
		html += "	<label class=\"col-md-4 control-label\" for=\"scoreInput\"><?php echo lang("myaccounts_validators_form_groupScoreInput"); ?></label>";
		html += "	<div class=\"col-md-2\">";
		html += "		<input id=\"scoreInput\" name=\"scoreInput\" value=\"\" type=\"text\"";
		html += "			placeholder=\"\" class=\"form-control input-md\">";
		html += "	</div>";
		html += "	<label class=\"col-md-4 control-label\" for=\"timelineInput\"><?php echo lang("myaccounts_validators_form_groupShowInTimeline"); ?></label>";
                html += "	<div class=\"col-md-2\">";
                html += "		<input id=\"timelineInput\" name=\"timelineInput\" value=\"1\" type=\"checkbox\"";
		html += "			placeholder=\"\" class=\"form-control input-md\">";
		html += "        </div>";
		html += "</div>";

		html += "<div class=\"form-group\">";
		html += "	<label class=\"col-md-4 control-label\" for=\"addValidatorInput\"><?php echo lang("myaccounts_validators_form_addUserInput"); ?></label>";
		html += "	<div class=\"col-md-6\">";
		html += "		<div class=\"input-group\">";
		html += "			<input";
		html += "				id=\"addValidatorInput\" name=\"addValidatorInput\" value=\"\" type=\"text\" placeholder=\"\" class=\"form-control input-md typeahead\"";
		html += "					data-provide=\"typeahead\" data-items=\"4\" data-soure=''>";
		html += "			<span class=\"input-group-btn\">";
		html += "				<button type=\"button\" class=\"addValidatorButton btn btn-default\">";
		html += "					<span class=\"glyphicon glyphicon-plus\"></span>";
		html += "				</button>";
		html += "			</span>";
		html += "		</div>";
		html += "		<p class=\"btn-group validators\"></p>";
		html += "	</div>";
		html += "</div>";

		html += "<div class=\"form-group\">";
		html += "	<label class=\"col-md-4 control-label\" for=\"deleteGroupButton\"></label>";
		html += "	<div class=\"col-md-8\">";
		html += "		<button id=\"deleteGroupButton\" name=\"deleteGroupButton\" class=\"deleteGroupButton btn btn-danger\"><?php echo lang("myaccounts_validators_form_deleteGroupInput"); ?></button>";
		html += "	</div>";
		html += "</div>";

		html += "<hr />";
		html += "</div>";

		html = $(html);

		html.find(".addValidatorButton").click(addValidatorHandler);
		html.find(".deleteGroupButton").click(deleteGroupClickHandler);

		$(this).parents(".addGroupDiv").before(html);
	});

	$(".addUserButton").click(function(event) {
		event.preventDefault();
		var button = $(this);
		var user = button.parent("span").siblings("input").val();

		$.post("do_getUserId.php", {"user": user}, function(data) {
			if (data.id) {
				var userLabel = "<span style=\"margin-right:5px; \" class=\"label label-default\">";
				userLabel += user;
				userLabel += "<input type=\"hidden\" class=\"administratorId\" value=\"" + data.id + "\" />";
				userLabel += "<span style=\"margin-left:5px; \" class=\"glyphicon glyphicon-remove\"></span></span>";
				userLabel = $(userLabel);

				userLabel.click(administratorClickHandler);

				button.parent("span").siblings("input").val("");
				button.parents("form").find(".administrators").append(userLabel);
			}
		}, "json");
	});

	$('.testTweeterButton').click(function (e) {
		e.preventDefault();

		var formInputs = $(this).parents("form");
		var myform = 	{
				apiKey: formInputs.find("#apiKeyInput").val(),
				apiSecret: formInputs.find("#apiSecretInput").val(),
				accessToken: formInputs.find("#accessTokenInput").val(),
				accessTokenSecret: formInputs.find("#accessTokenSecretInput").val()
			};

		$.post("do_testTwitter.php", myform, function(data) {
			if (data.ok) {
				formInputs.find("#ok_twitter_successAlert").show().delay(2000).fadeOut(1000);
			}
			else {
				formInputs.find("#" + data.message + "Alert").show().delay(2000).fadeOut(1000);
			}
		}, "json");
	});

	$('.createMastodonAccessButton').click(function (e) {
		e.preventDefault();

		var formInputs = $(this).parents("form");
		var myform = 	{
				url: formInputs.find("#mstdUrlInput").val(),
				clientName: formInputs.find("#mstdClientNameInput").val(),
				email: formInputs.find("#mstdEmailInput").val(),
				password: formInputs.find("#mstdPasswordInput").val()
			};
		
		$.post("do_createMastodonAccess.php", myform, function(data) {
			if (data.ok) {
				formInputs.find("#ok_mastodon_successAlert").show().delay(2000).fadeOut(1000);

				formInputs.find("#mstdClientIdInput").val(data.smc_client_id);
				formInputs.find("#mstdClientSecretInput").val(data.smc_client_secret);
				formInputs.find("#mstdUserTokenInput").val(data.smc_user_token);
			}
			else {
				formInputs.find("#" + data.message + "Alert").show().delay(2000).fadeOut(1000);
			}
		}, "json");
	});

	$('.testMastodonButton').click(function (e) {
		e.preventDefault();

		var formInputs = $(this).parents("form");
		var myform = 	{
				url: formInputs.find("#mstdUrlInput").val(),
				clientId: formInputs.find("#mstdClientIdInput").val(),
				clientSecret: formInputs.find("#mstdClientSecretInput").val(),
				userToken: formInputs.find("#mstdUserTokenInput").val(),
				tokenType: formInputs.find("#mstdTokenTypeInput").val()
			};

		$.post("do_testMastodon.php", myform, function(data) {
			if (data.ok) {
				formInputs.find("#ok_mastodon_successAlert").show().delay(2000).fadeOut(1000);
			}
			else {
				formInputs.find("#" + data.message + "Alert").show().delay(2000).fadeOut(1000);
			}
		}, "json");
	});

	$('.saveAccountButton').click(function (e) {
		e.preventDefault();

		var formInputs = $(this).parents("form");

		var administratorIdInputs = formInputs.find(".administratorId");
		var administratorIds = [];

		administratorIdInputs.each(function() {
			administratorIds[administratorIds.length] = $(this).val();
		});

		var validatorGroups = [];

		formInputs.find(".validatorGroup").each(function() {
			var validatorGroup = {	vgr_name: $(this).find("#nameInput").val(),
									vgr_score: $(this).find("#scoreInput").val(),
					      				vgr_show_timeline: $(this).find("#timelineInput:checked").length,
									validators: []};

			var validatorIdInputs = $(this).find(".validators .validatorId");

			validatorIdInputs.each(function() {
				validatorGroup.validators[validatorGroup.validators.length] = {
																				use_id : $(this).val(),
																				use_login : ""
																			  };
			});

			validatorGroups[validatorGroups.length] = validatorGroup;
		});

		var myform = 	{
							id: formInputs.find("#accountIdInput").val(),
							name: formInputs.find("#nameInput").val(),
							validationScore: formInputs.find("#validationScoreInput").val(),
							validationScore: formInputs.find("#validationScoreInput").val(),
							anonymousPermitted: formInputs.find("#anonymousInput").attr("checked") ? "1" : "0",
							anonymousPassword: formInputs.find("#anonymousPasswordInput").val(),
							
							apiKey: formInputs.find("#apiKeyInput").val(),
							apiSecret: formInputs.find("#apiSecretInput").val(),
							accessToken: formInputs.find("#accessTokenInput").val(),
							accessTokenSecret: formInputs.find("#accessTokenSecretInput").val(),

							pageId: formInputs.find("#pageIdInput").val(),
							fpAccessToken: formInputs.find("#fpAccessTokenInput").val(),

							url: formInputs.find("#mstdUrlInput").val(),
							clientId: formInputs.find("#mstdClientIdInput").val(),
							clientSecret: formInputs.find("#mstdClientSecretInput").val(),
							userToken: formInputs.find("#mstdUserTokenInput").val(),
							tokenType: formInputs.find("#mstdTokenTypeInput").val(),

							administratorIds: JSON.stringify(administratorIds),
							validatorGroups: JSON.stringify(validatorGroups)
						};

//		debugger;
		
		$.post("do_myaccounts.php", myform, responseHandler, "json");
	});

	if (window.location.hash) {
		$("a[aria-controls='"+window.location.hash.replace("#","")+"']").tab('show');
	}

	$("li a[data-toggle=tab]").click(function(event) {
		var anchor = $(this).attr("aria-controls");
		window.location.hash = "#" + anchor;
	});

	$("input[type=checkbox]").click(function(event) {
		if ($(this).attr("checked")) {
			$(this).removeAttr("checked");
		}
		else {
			$(this).attr("checked", "checked");
		}

		if ($(this).attr("id") == "anonymousInput") {
			$(this).parents("form").find("#anonymousPasswordInput").removeAttr("disabled");
			if (!$(this).attr("checked")) {
				$(this).parents("form").find("#anonymousPasswordInput").attr("disabled", "disabled");
			}
		}
	});

	$(".toggle-create-access-token").click(function() {
		var parentForm = $(this).parents("form");

		if ($(this).find("span").hasClass("glyphicon-plus")) {
			parentForm.find(".create-access-token").show();
			$(this).find("span").removeClass("glyphicon-plus");
			$(this).find("span").addClass("glyphicon-minus");
		}
		else {
			parentForm.find(".create-access-token").hide();
			$(this).find("span").addClass("glyphicon-plus");
			$(this).find("span").removeClass("glyphicon-minus");
		}
	});

	$(".createFacebookPageAccessTokenButton").click(function(event) {
		event.preventDefault();
		event.stopPropagation();

		var parentForm = $(this).parents("form");

		var myForm = 	{
							pageId : parentForm.find("#pageIdInput").val(),
							applicationId : parentForm.find("#applicationIdInput").val(),
							applicationSecretKey : parentForm.find("#applicationSecretKeyInput").val(),
							shortLiveUserAccessToken : parentForm.find("#shortLiveUserAccessTokenInput").val()
						};

		$.post("do_createFacebookPageAccessToken.php", myForm, function(data) {
			parentForm.find("#fpAccessTokenInput").val(data.accessToken);

			parentForm.find(".create-access-token").hide();
			parentForm.find(".toggle-create-access-token span").addClass("glyphicon-plus");
			parentForm.find(".toggle-create-access-token span").removeClass("glyphicon-minus");
		}, "json");
	});

	$(".create-access-token").hide();
});
</script>
</body>
</html>
