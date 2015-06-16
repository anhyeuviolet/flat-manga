<?
	if($_POST && $_GET[token] == $_SESSION[token]){
	if($_POST[read_type_choose] == '1'){ $_POST[read_type] = '$_COOKIE[read_type]';}
		$string = '<?
		$timezone = "'.$_POST[timezone].'";
		date_default_timezone_set($timezone);
		$today = date("Y-m-d");
		$yester_day = date("d")-1;
		$yesterday = date("Y-m-").\'-\'.$yester_day;
		$config[title] = "'.$_POST[title].'" ;
		$config[title_display] = "'.$_POST[title].'" ;
		$config[admin_pw] = "'.$_POST[admin_pw].'";
		$config[lang] = "'.$_POST[language].'";
		$config[last_update_home] = "'.$_POST[last_update_home].'";
		$config[read_type] = "'.$_POST[read_type].'";
		$config[read_type_choose] = "'.$_POST[read_type_choose].'";
		$config[comment_type] = "'.$_POST[comment_type].'";
		$config[comment_string] = "'.$_POST[comment_string].'";
		$config[most_popular] = "'.$_POST[most_popular].'"; 
		$config[theme] = "'.$_POST[theme].'";
		?>';
		$fp = fopen("./includes/settings.php", "w");
		fwrite($fp, $string);
		fclose($fp);
		redirect('index.php?view=admin&sub_view=setting');
	}
?>
<div class="col-lg-12">
	<div class="well">
	  <form class="bs-example form-horizontal" method="POST" action="index.php?view=admin&sub_view=setting&token=<?=$_SESSION[token]?>">
		<fieldset>
		  <legend><?=$lang[General_Settings];?></legend>
		  <div class="form-group">
			<label for="select" class="col-lg-3 control-label"><?=$lang[Time_zone];?></label>
			<div class="col-lg-9">
			  <select class="form-control" id="select" name='timezone'>
				<option value="Asia/Ho_Chi_Minh">Asia/Ho_Chi_Minh</option>
				<option value="America/Los_Angeles">America/Los_Angeles</option>
			  </select>
			</div>
		  </div>
		  <div class="form-group">
			<label for="inputEmail" class="col-lg-3 control-label"><?=$lang[Site_title]?></label>
			<div class="col-lg-9">
			  <input type="text" class="form-control" id="inputEmail" name="title" value="<?=$config[title]?>">
			</div>
		  </div>
		  <div class="form-group">
			<label for="inputEmail" class="col-lg-3 control-label"><?=$lang[Admin_pass]?></label>
			<div class="col-lg-9">
			  <input type="password" class="form-control" id="inputEmail" name="admin_pw" value="<?=$config[admin_pw]?>">
			  <span class="help-block"><?=$lang[Admin_pw_ex]?></span>
			</div>
		  </div>
		  <div class="form-group">
			<label class="col-lg-3 control-label"><?=$lang[Language]?></label>
			<div class="col-lg-9">
			  <div class="radio">
				<label>
				  <input type="radio" name="language" id="optionsRadios1" value="vi" <?=(($config[lang] == 'vi') ? 'checked' : '')?>>
				  <?=$lang[Vi]?>
				</label>
			  </div>
			  <div class="radio">
				<label>
				  <input type="radio" name="language" id="optionsRadios2" value="en" <?=(($config[lang] == 'en') ? 'checked' : '')?>>
				  <?=$lang[Eng]?>
				</label>
			  </div>
			</div>
		  </div>
		  <legend><?=$lang[Read_comment];?></legend>
		  <div class="form-group">
			<label class="col-lg-3 control-label"><?=$lang[def_read_type]?></label>
			<div class="col-lg-9">
			  <div class="radio">
				<label>
				  <input type="radio" name="read_type" id="optionsRadios1" value="1" <?=(($config[read_type] == '1') ? 'checked' : '')?>>
				  <?=$lang[Webtoon]?>
				</label>
			  </div>
			  <div class="radio">
				<label>
				  <input type="radio" name="read_type" id="optionsRadios2" value="2" <?=(($config[read_type] == '2') ? 'checked' : '')?>>
				  <?=$lang[Page_by_page]?>
				</label>
			  </div>
			  <div class="radio">
				<label>
				  <input type="radio" name="read_type" id="optionsRadios2" value="3" <?=(($config[read_type] == '3') ? 'checked' : '')?>>
				  <?=$lang[Page_by_page_touch]?>
				</label>
			  </div>
			</div>
		  </div>
		  <div class="form-group">
			<label class="col-lg-3 control-label"><?=$lang[can_user_choose]?></label>
			<div class="col-lg-9">
			  <div class="radio">
				<label>
				  <input type="radio" name="read_type_choose" id="optionsRadios1" value="1" <?=(($config[read_type_choose] == '1') ? 'checked' : '')?>>
				  <?=$lang[Yes]?>
				</label>
			  </div>
			  <div class="radio">
				<label>
				  <input type="radio" name="read_type_choose" id="optionsRadios2" value="0" <?=(($config[read_type_choose] == '0') ? 'checked' : '')?>>
				  <?=$lang[No]?>
				</label>
			  </div>
			<span class="help-block"><?=$lang[X_read_type]?></span>  
			</div>
		  </div>
		  <div class="form-group">
			<label class="col-lg-3 control-label"><?=$lang[comment_type]?></label>
			<div class="col-lg-9">
			  <div class="radio">
				<label>
				  <input type="radio" name="comment_type" id="optionsRadios1" value="1" <?=(($config[comment_type] == '1') ? 'checked' : '')?>>
				  Facebook
				</label>
			  </div>
			  <div class="radio">
				<label>
				  <input type="radio" name="comment_type" id="optionsRadios2" value="2" <?=(($config[comment_type] == '2') ? 'checked' : '')?>>
				  Disqus
				</label>
			  </div>
			</div>
		  </div>		  
		  <div class="form-group">
			<label for="select" class="col-lg-3 control-label"><?=$lang[Facebook_or_disqus];?></label>
			<div class="col-lg-9">
			  <input type="text" class="form-control" name="comment_string" value="<?=$config[comment_string]?>">
			  <span class="help-block"><?=$lang[Facebook_or_disqus_ex]?></span>
			</div>
		  </div>
		  <legend><?=$lang[Themes_widget];?></legend>
		  <div class="form-group">
			<label class="col-lg-3 control-label"><?=$lang[theme]?></label>
			<div class="col-lg-9">
			  <div class="radio">
				<label>
				  <input type="radio" name="theme" id="optionsRadios1" value="default" <?=(($config[theme] == 'default') ? 'checked' : '')?>>
				  Default
				</label>
			  </div>
			  <div class="radio">
				<label>
				  <input type="radio" name="theme" id="optionsRadios2" value="flat" <?=(($config[theme] == 'flat') ? 'checked' : '')?>>
				  Flat
				</label>
			  </div>
			  <div class="radio">
				<label>
				  <input type="radio" name="theme" id="optionsRadios2" value="cerulean" <?=(($config[theme] == 'cerulean') ? 'checked' : '')?>>
				  Cerulean
				</label>
			  </div>
			  <div class="radio">
				<label>
				  <input type="radio" name="theme" id="optionsRadios2" value="amelia" <?=(($config[theme] == 'amelia') ? 'checked' : '')?>>
				  Amelia
				</label>
			  </div>
			  <div class="radio">
				<label>
				  <input type="radio" name="theme" id="optionsRadios2" value="cosmo" <?=(($config[theme] == 'cosmo') ? 'checked' : '')?>>
				  Cosmo
				</label>
			  </div>
			  <div class="radio">
				<label>
				  <input type="radio" name="theme" id="optionsRadios2" value="cyborg" <?=(($config[theme] == 'cyborg') ? 'checked' : '')?>>
				  Cyborg (Dark)
				</label>
			  </div>
			  <div class="radio">
				<label>
				  <input type="radio" name="theme" id="optionsRadios2" value="journal" <?=(($config[theme] == 'journal') ? 'checked' : '')?>>
				  Journal
				</label>
			  </div>
			  <div class="radio">
				<label>
				  <input type="radio" name="theme" id="optionsRadios2" value="readable" <?=(($config[theme] == 'readable') ? 'checked' : '')?>>
				  Readable
				</label>
			  </div>
			  <div class="radio">
				<label>
				  <input type="radio" name="theme" id="optionsRadios2" value="simplex" <?=(($config[theme] == 'simplex') ? 'checked' : '')?>>
				  Simplex
				</label>
			  </div>
			  <div class="radio">
				<label>
				  <input type="radio" name="theme" id="optionsRadios2" value="slate" <?=(($config[theme] == 'slate') ? 'checked' : '')?>>
				  Slate (Dark)
				</label>
			  </div>
			  <div class="radio">
				<label>
				  <input type="radio" name="theme" id="optionsRadios2" value="united" <?=(($config[theme] == 'united') ? 'checked' : '')?>>
				  United
				</label>
			  </div>
			  <div class="radio">
				<label>
				  <input type="radio" name="theme" id="optionsRadios2" value="spacelab" <?=(($config[theme] == 'spacelab') ? 'checked' : '')?>>
				  Spacelab
				</label>
			  </div>
			<span class="help-block"><?=$lang[X_read_type]?></span>  
			</div>
		  </div>
		  <div class="form-group">
			<label for="select" class="col-lg-3 control-label"><?=$lang[X_updated]?></label>
			<div class="col-lg-9">
			  <select class="form-control" name="last_update_home" id="select">
				<option value="5" <?=($config[last_update_home] == '5' ? 'selected' : '')?>>5</option>
				<option value="10" <?=($config[last_update_home] == '10' ? 'selected' : '')?>>10</option>
				<option value="15" <?=($config[last_update_home] == '15' ? 'selected' : '')?>>15</option>
				<option value="20" <?=($config[last_update_home] == '20' ? 'selected' : '')?>>20</option>
				<option value="25" <?=($config[last_update_home] == '25' ? 'selected' : '')?>>25</option>
				<option value="30" <?=($config[last_update_home] == '30' ? 'selected' : '')?>>30</option>
				<option value="35" <?=($config[last_update_home] == '35' ? 'selected' : '')?>>35</option>
				<option value="40" <?=($config[most_popular] == '40' ? 'selected' : '')?>>40</option>
			  </select>
			<span class="help-block"><?=$lang[X_updated_ex]?></span>  
			</div>
		  </div>
		  <div class="form-group">
			<label for="select" class="col-lg-3 control-label"><?=$lang[X_most]?></label>
			<div class="col-lg-9">
			  <select class="form-control" name="most_popular" id="select">
				<option value="5" <?=($config[most_popular] == '5' ? 'selected' : '')?>>5</option>
				<option value="10" <?=($config[most_popular] == '10' ? 'selected' : '')?>>10</option>
				<option value="15" <?=($config[most_popular] == '15' ? 'selected' : '')?>>15</option>
				<option value="20" <?=($config[most_popular] == '20' ? 'selected' : '')?>>20</option>
				<option value="25" <?=($config[most_popular] == '25' ? 'selected' : '')?>>25</option>
				<option value="30" <?=($config[most_popular] == '30' ? 'selected' : '')?>>30</option>
				<option value="35" <?=($config[most_popular] == '35' ? 'selected' : '')?>>35</option>
				<option value="40" <?=($config[most_popular] == '40' ? 'selected' : '')?>>40</option>
			  </select>
			<span class="help-block"><?=$lang[X_most_ex]?></span>  
			</div>
		  </div>
		  <div class="form-group">
			<div class="col-lg-10 col-lg-offset-2">
			  <button type="submit" class="btn btn-primary"><?=$lang[Submit]?></button> 
			</div>
		  </div>
		</fieldset>
	  </form>
	</div>
  </div>