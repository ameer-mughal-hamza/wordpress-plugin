<div class="wrap metabox-holder">
    <h1>General Options</h1>
    <?php if (isset($_REQUEST['settings-updated']) && $_REQUEST['settings-updated'] == 'true') : ?>
        <div class="updated"><p><strong><?php _e('Options saved'); ?></strong></p></div>
    <?php endif; ?>
    <form method="post" action="options.php" onsubmit="return dsIDXpressOptions.FilterViews();">
        <?php settings_fields("dsidxpress_options"); ?>
        <h2>Display Settings</h2>
        <table class="form-table">
            <?php if (!defined('ZPRESS_API') || ZPRESS_API == '') : ?>
                <tr>
                    <th>
                        <label for="dsidxpress-DetailsTemplate">Template for details pages:</label>
                    </th>
                    <td>
                        <select id="dsidxpress-DetailsTemplate"
                                name="<?php echo DSIDXPRESS_OPTION_NAME; ?>[DetailsTemplate]">
                            <option value="">- Default -</option>
                            <?php
                            $details_template = (isset($options["DetailsTemplate"])) ? $options["DetailsTemplate"] : '';
                            page_template_dropdown($details_template);
                            ?>
                        </select><br/>
                        <span class="description">Some themes have custom templates that can change how a particular page is displayed. If your theme does have multiple templates, you'll be able to select which one you want to use in the drop-down above.</span>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="dsidxpress-ResultsTemplate">Template for results pages:</label>
                    </th>
                    <td>
                        <select id="dsidxpress-ResultsTemplate"
                                name="<?php echo DSIDXPRESS_OPTION_NAME; ?>[ResultsTemplate]">
                            <option value="">- Default -</option>
                            <?php
                            $results_template = (isset($options["ResultsTemplate"])) ? $options["ResultsTemplate"] : '';
                            page_template_dropdown($results_template);
                            ?>
                        </select><br/>
                        <span class="description">See above.</span>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="dsidxpress-AdvancedTemplate">Template for dsSearchAgent:</label>
                    </th>
                    <td>
                        <select id="dsidxpress-AdvancedTemplate"
                                name="<?php echo DSIDXPRESS_OPTION_NAME; ?>[AdvancedTemplate]">
                            <option value="">- Default -</option>
                            <?php
                            $advanced_template = (isset($options["AdvancedTemplate"])) ? $options["AdvancedTemplate"] : '';
                            page_template_dropdown($advanced_template);
                            ?>
                        </select><br/>
                        <span class="description">See above.</span>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="dsidxpress-IDXTemplate">Template for IDX pages:</label>
                    </th>
                    <td>
                        <select id="dsidxpress-IDXTemplate" name="<?php echo DSIDXPRESS_OPTION_NAME; ?>[IDXTemplate]">
                            <option value="">- Default -</option>
                            <?php
                            $idx_template = (isset($options["IDXTemplate"])) ? $options["IDXTemplate"] : '';
                            page_template_dropdown($idx_template);
                            ?>
                        </select><br/>
                        <span class="description">See above.</span>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="dsidxpress-404Template">Template for error pages:</label>
                    </th>
                    <td>
                        <select id="dsidxpress-404Template" name="<?php echo DSIDXPRESS_OPTION_NAME; ?>[404Template]">
                            <option value="">- Default -</option>
                            <optgroup label="Template">
                                <?php
                                $error_template = (isset($options["404Template"])) ? $options["404Template"] : '';
                                $error_404 = locate_template('404.php');
                                if (!empty($error_404)) {
                                    ?>
                                    <option value="404.php"<?php echo($error_template == '404.php' ? ' selected' : ''); ?>>
                                        404.php
                                    </option>
                                    <?php
                                }
                                ?>
                                <?php
                                $error_template = (isset($options["404Template"])) ? $options["404Template"] : '';
                                page_template_dropdown($error_template);
                                ?>
                            </optgroup>
                            <optgroup label="Page">
                                <?php
                                $pages = get_posts(
                                    array(
                                        'post_type' => 'page',
                                        'posts_per_page' => -1
                                    )
                                );
                                foreach ($pages as $page) {
                                    echo '<option value="' . $page->ID . '"' . ($error_template == $page->ID ? ' selected' : '') . '>' . $page->post_title . '</option>';
                                }
                                wp_reset_postdata();
                                ?>
                            </optgroup>
                        </select><br/>
                        <span class="description">See above.</span>
                    </td>
                </tr>
            <?php endif; ?>
            <tr>
                <th>
                    <label for="dsidxpress-CustomTitleText">Title for results pages:</label>
                </th>
                <td>
                    <input type="text" id="dsidxpress-CustomTitleText" maxlength="49"
                           name="<?php echo DSIDXPRESS_API_OPTIONS_NAME; ?>[CustomTitleText]"
                           value="<?php echo $account_options->CustomTitleText; ?>"/><br/>
                    <span class="description">By default, the titles are auto-generated based on the type of area searched. You can override this above; use <code>%title%</code> to designate where you want the location title. For example, you could use <code>Real estate in the %title%</code>.</span>
                </td>
            </tr>
            <tr>
                <th>
                    <label for="dsidxpress-ResultsMapDefaultState">Default view for Results pages:</label>
                </th>
                <td>
                    <input type="radio" id="dsidxpress-ResultsDefaultState-List"
                           name="<?php echo DSIDXPRESS_OPTION_NAME; ?>[ResultsDefaultState]"
                           value="list" <?php echo @$options["ResultsDefaultState"] == "list" || !isset($options["ResultsDefaultState"]) ? "checked=\"checked\"" : "" ?>/>
                    <label for="dsidxpress-ResultsDefaultState-List">List</label><br/>
                    <input type="radio" id="dsidxpress-ResultsDefaultState-ListMap"
                           name="<?php echo DSIDXPRESS_OPTION_NAME; ?>[ResultsDefaultState]"
                           value="listmap" <?php echo @$options["ResultsDefaultState"] == "listmap" ? "checked=\"checked\"" : "" ?> />
                    <label for="dsidxpress-ResultsDefaultState-ListMap">List + Map</label>
                    <?php if (defined('ZPRESS_API') || isset($options["dsIDXPressPackage"]) && $options["dsIDXPressPackage"] == "pro"): ?>
                        <br/><input type="radio" id="dsidxpress-ResultsDefaultState-Grid"
                                    name="<?php echo DSIDXPRESS_OPTION_NAME; ?>[ResultsDefaultState]"
                                    value="grid" <?php echo @$options["ResultsDefaultState"] == "grid" ? "checked=\"checked\"" : "" ?>/>
                        <label for="dsidxpress-ResultsDefaultState-Grid">Grid</label>
                    <?php endif ?>
                </td>
            </tr>
            <tr>
                <th>
                    <label for="dsidxpress-ResultsMapDefaultState">Property Details Image Display:</label>
                </th>
                <td>
                    <input type="radio" id="dsidxpress-ImageDisplay-Slideshow"
                           name="<?php echo DSIDXPRESS_OPTION_NAME; ?>[ImageDisplay]"
                           value="slideshow" <?php echo @$options["ImageDisplay"] == "slideshow" || !isset($options["ImageDisplay"]) ? "checked=\"checked\"" : "" ?>/>
                    <label for="dsidxpress-ImageDisplay-Slideshow">Rotating Slideshow</label><br/>
                    <input type="radio" id="dsidxpress-ImageDisplay-Thumbnail"
                           name="<?php echo DSIDXPRESS_OPTION_NAME; ?>[ImageDisplay]"
                           value="thumbnail" <?php echo @$options["ImageDisplay"] == "thumbnail" ? "checked=\"checked\"" : "" ?> />
                    <label for="dsidxpress-ImageDisplay-Thumbnail">Thumbnail Display</label>
                </td>
            </tr>
        </table>
        <?php if (defined('ZPRESS_API') || isset($options["dsIDXPressPackage"]) && $options["dsIDXPressPackage"] == "pro"): ?>
            <h2>Registration Options</h2>
            <table class="form-table">
                <tr>
                    <th>
                        <label for="dsidxpress-RequiredPhone-check">Require phone numbers for visitor registration and
                            contact forms</label>
                    </th>
                    <td>
                        <input type="hidden" id="dsidxpress-RequiredPhone"
                               name="<?php echo DSIDXPRESS_API_OPTIONS_NAME; ?>[RequiredPhone]"
                               value="<?php echo $account_options->{'RequiredPhone'}; ?>"/>
                        <input type="checkbox" class="dsidxpress-api-checkbox"
                               id="dsidxpress-RequiredPhone-check" <?php checked('true', strtolower($account_options->{'RequiredPhone'})); ?> />
                    </td>
                </tr>
            </table>
            <h2>Forced Registration Settings</h2>
            <table class="form-table">
                <tr>
                    <th>
                        <label for="dsidxpress-NumofDetailsViews">Number of detail views before required
                            registration</label>
                    </th>
                    <td>
                        <input type="text" id="dsidxpress-NumOfDetailsViews"
                               name="<?php echo DSIDXPRESS_API_OPTIONS_NAME; ?>[AllowedDetailViewsBeforeRegistration]"
                               value="<?php echo $account_options->AllowedDetailViewsBeforeRegistration; ?>"/>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="dsidxpress-NumofResultsViews">Number of result views before required
                            registration</label>
                    </th>
                    <td>
                        <input type="text" id="dsidxpress-NumOfResultViews"
                               name="<?php echo DSIDXPRESS_API_OPTIONS_NAME; ?>[AllowedSearchesBeforeRegistration]"
                               value="<?php echo $account_options->AllowedSearchesBeforeRegistration; ?>"/>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="dsidxpress-RequireAuth-Details-Description-check">Require login to view
                            description</label>
                    </th>
                    <td>
                        <input type="hidden" id="dsidxpress-RequireAuth-Details-Description"
                               name="<?php echo DSIDXPRESS_API_OPTIONS_NAME; ?>[RequireAuth-Details-Description]"
                               value="<?php echo $account_options->{'RequireAuth-Details-Description'}; ?>"/>
                        <input type="checkbox" class="dsidxpress-api-checkbox"
                               id="dsidxpress-RequireAuth-Details-Description-check" <?php checked('true', strtolower($account_options->{'RequireAuth-Details-Description'})); ?> />
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="dsidxpress-RequireAuth-Property-Community">Require login to view the
                            community</label>
                    </th>
                    <td>
                        <input type="hidden" id="dsidxpress-RequireAuth-Property-Community"
                               name="<?php echo DSIDXPRESS_API_OPTIONS_NAME; ?>[RequireAuth-Property-Community]"
                               value="<?php echo $account_options->{'RequireAuth-Property-Community'}; ?>"/>
                        <input type="checkbox" class="dsidxpress-api-checkbox"
                               id="dsidxpress-RequireAuth-Property-Community-check" <?php checked('true', strtolower($account_options->{'RequireAuth-Property-Community'})); ?> />
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="dsidxpress-RequireAuth-Property-Tract-check">Require login to view the tract</label>
                    </th>
                    <td>
                        <input type="hidden" id="dsidxpress-RequireAuth-Property-Tract"
                               name="<?php echo DSIDXPRESS_API_OPTIONS_NAME; ?>[RequireAuth-Property-Tract]"
                               value="<?php echo $account_options->{'RequireAuth-Property-Tract'}; ?>"/>
                        <input type="checkbox" class="dsidxpress-api-checkbox"
                               id="dsidxpress-RequireAuth-Property-Tract-check" <?php checked('true', strtolower($account_options->{'RequireAuth-Property-Tract'})); ?> />
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="dsidxpress-RequireAuth-Details-Schools-check">Require login to view schools</label>
                    </th>
                    <td>
                        <input type="hidden" id="dsidxpress-RequireAuth-Details-Schools"
                               name="<?php echo DSIDXPRESS_API_OPTIONS_NAME; ?>[RequireAuth-Details-Schools]"
                               value="<?php echo $account_options->{'RequireAuth-Details-Schools'}; ?>"/>
                        <input type="checkbox" class="dsidxpress-api-checkbox"
                               id="dsidxpress-RequireAuth-Details-Schools-check" <?php checked('true', strtolower($account_options->{'RequireAuth-Details-Schools'})); ?> />
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="dsidxpress-RequireAuth-Details-AdditionalInfo-check">Require login to view
                            additional info</label>
                    </th>
                    <td>
                        <input type="hidden" id="dsidxpress-RequireAuth-Details-AdditionalInfo"
                               name="<?php echo DSIDXPRESS_API_OPTIONS_NAME; ?>[RequireAuth-Details-AdditionalInfo]"
                               value="<?php echo $account_options->{'RequireAuth-Details-AdditionalInfo'}; ?>"/>
                        <input type="checkbox" class="dsidxpress-api-checkbox"
                               id="dsidxpress-RequireAuth-Details-AdditionalInfo-check" <?php checked('true', strtolower($account_options->{'RequireAuth-Details-AdditionalInfo'})); ?> />
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="dsidxpress-RequireAuth-Details-PriceChanges-check">Require login to view price
                            changes</label>
                    </th>
                    <td>
                        <input type="hidden" id="dsidxpress-RequireAuth-Details-PriceChanges"
                               name="<?php echo DSIDXPRESS_API_OPTIONS_NAME; ?>[RequireAuth-Details-PriceChanges]"
                               value="<?php echo $account_options->{'RequireAuth-Details-PriceChanges'}; ?>"/>
                        <input type="checkbox" class="dsidxpress-api-checkbox"
                               id="dsidxpress-RequireAuth-Details-PriceChanges-check" <?php checked('true', strtolower($account_options->{'RequireAuth-Details-PriceChanges'})); ?> />
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="dsidxpress-RequireAuth-Details-Features-check">Require login to view
                            features</label>
                    </th>
                    <td>
                        <input type="hidden" id="dsidxpress-RequireAuth-Details-Features"
                               name="<?php echo DSIDXPRESS_API_OPTIONS_NAME; ?>[RequireAuth-Details-Features]"
                               value="<?php echo $account_options->{'RequireAuth-Details-Features'}; ?>"/>
                        <input type="checkbox" class="dsidxpress-api-checkbox"
                               id="dsidxpress-RequireAuth-Details-Features-check" <?php checked('true', strtolower($account_options->{'RequireAuth-Details-Features'})); ?> />
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="dsidxpress-RequireAuth-Property-DaysOnMarket-check">Require login to view days on
                            market</label>
                    </th>
                    <td>
                        <input type="hidden" id="dsidxpress-RequireAuth-Property-DaysOnMarket"
                               name="<?php echo DSIDXPRESS_API_OPTIONS_NAME; ?>[RequireAuth-Property-DaysOnMarket]"
                               value="<?php echo $account_options->{'RequireAuth-Property-DaysOnMarket'}; ?>"/>
                        <input type="checkbox" class="dsidxpress-api-checkbox"
                               id="dsidxpress-RequireAuth-Property-DaysOnMarket-check" <?php checked('true', strtolower($account_options->{'RequireAuth-Property-DaysOnMarket'})); ?> />
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="dsidxpress-RequireAuth-Property-LastUpdated-check">Require login to view last update
                            date</label>
                    </th>
                    <td>
                        <input type="hidden" id="dsidxpress-RequireAuth-Property-LastUpdated"
                               name="<?php echo DSIDXPRESS_API_OPTIONS_NAME; ?>[RequireAuth-Property-LastUpdated]"
                               value="<?php echo $account_options->{'RequireAuth-Property-LastUpdated'}; ?>"/>
                        <input type="checkbox" class="dsidxpress-api-checkbox"
                               id="dsidxpress-RequireAuth-Property-LastUpdated-check" <?php checked('true', strtolower($account_options->{'RequireAuth-Property-LastUpdated'})); ?> />
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="dsidxpress-RequireAuth-Property-YearBuilt-check">Require login to view year
                            built</label>
                    </th>
                    <td>
                        <input type="hidden" id="dsidxpress-RequireAuth-Property-YearBuilt"
                               name="<?php echo DSIDXPRESS_API_OPTIONS_NAME; ?>[RequireAuth-Property-YearBuilt]"
                               value="<?php echo $account_options->{'RequireAuth-Property-YearBuilt'}; ?>"/>
                        <input type="checkbox" class="dsidxpress-api-checkbox"
                               id="dsidxpress-RequireAuth-Property-YearBuilt-check" <?php checked('true', strtolower($account_options->{'RequireAuth-Property-YearBuilt'})); ?> />
                    </td>
                </tr>
            </table>
        <?php endif ?>
        <?php if (!defined('ZPRESS_API') || ZPRESS_API == '') : ?>
            <h2>Contact Information</h2>
            <span class="description">This information is used in identifying you to the website visitor. For example: Listing PDF Printouts, Contact Forms, and Dwellicious</span>
            <table class="form-table">
                <tr>
                    <th>
                        <label for="dsidxpress-FirstName">First Name:</label>
                    </th>
                    <td>
                        <input type="text" id="dsidxpress-FirstName" maxlength="49"
                               name="<?php echo DSIDXPRESS_API_OPTIONS_NAME; ?>[FirstName]"
                               value="<?php echo $account_options->FirstName; ?>"/><br/>
                        <span class="description"></span>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="dsidxpress-LastName">Last Name:</label>
                    </th>
                    <td>
                        <input type="text" id="dsidxpress-LastName" maxlength="49"
                               name="<?php echo DSIDXPRESS_API_OPTIONS_NAME; ?>[LastName]"
                               value="<?php echo $account_options->LastName; ?>"/><br/>
                        <span class="description"></span>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="dsidxpress-Email">Email:</label>
                    </th>
                    <td>
                        <input type="text" id="dsidxpress-Email" maxlength="49"
                               name="<?php echo DSIDXPRESS_API_OPTIONS_NAME; ?>[Email]"
                               value="<?php echo $account_options->Email; ?>"/><br/>
                        <span class="description"></span>
                    </td>
                </tr>
            </table>

            <h2>Copyright Settings</h2>
            <span class="description">This setting allows you to remove links to <a
                        href="http://www.diversesolutions.com">Diverse Solutions</a> that are included in the IDX disclaimer.</span>
            <table class="form-table">
                <tr>
                    <th>
                        <label for="dsidxpress-RemoveDsDisclaimerLinks">Remove Diverse Solutions links</label>
                    </th>
                    <td>
                        <input type="checkbox" id="dsidxpress-RemoveDsDisclaimerLinks"
                               name="<?php echo DSIDXPRESS_OPTION_NAME; ?>[RemoveDsDisclaimerLinks]"
                               value="Y"<?php if (isset($options['RemoveDsDisclaimerLinks']) && $options['RemoveDsDisclaimerLinks'] == 'Y'): ?> checked="checked"<?php endif ?> />
                    </td>
                </tr>
            </table>
        <?php endif; ?>
        <h2>Mobile Settings</h2>
        <span class="description">To set up a custom mobile domain you must configure your DNS to point a domain, or subdomain, at app.dsmobileidx.com. Then enter the custom domain's full url here. Example: http://mobile.myrealestatesite.com</span>
        <table class="form-table">
            <tr>
                <th>
                    <label for="dsidxpress-MobileSiteUrl">Custom Mobile Domain:</label>
                </th>
                <td>
                    <input type="text" id="dsidxpress-MobileSiteUrl" maxlength="100"
                           name="<?php echo DSIDXPRESS_API_OPTIONS_NAME; ?>[MobileSiteUrl]"
                           value="<?php echo $account_options->MobileSiteUrl; ?>"/>
                </td>
            </tr>
        </table>
        <h2>My Listings</h2>
        <span class="description">When filled in, these settings will make pages for "My Listings" and "My Office Listings" available in your navigation menus page list.</span>
        <table class="form-table">
            <tr>
                <th>
                    <label for="dsidxpress-AgentID">Agent ID:</label>
                </th>
                <td>
                    <input type="text" id="dsidxpress-AgentID" maxlength="35"
                           name="<?php echo DSIDXPRESS_OPTION_NAME; ?>[AgentID]"
                           value="<?php echo(!empty($options['AgentID']) ? $options['AgentID'] : $account_options->AgentID); ?>"/><br/>
                    <span class="description">This is the Agent ID as assigned to you by the MLS you are using to provide data to this site.</span>
                    <input type="hidden" id="dsidxpress-API-AgentID" maxlength="35"
                           name="<?php echo DSIDXPRESS_API_OPTIONS_NAME; ?>[AgentID]"
                           value="<?php echo(!empty($options['AgentID']) ? $options['AgentID'] : $account_options->AgentID); ?>"/><br/>
                </td>
            </tr>
            <tr>
                <th>
                    <label for="dsidxpress-OfficeID">Office ID:</label>
                </th>
                <td>
                    <input type="text" id="dsidxpress-OfficeID" maxlength="35"
                           name="<?php echo DSIDXPRESS_OPTION_NAME; ?>[OfficeID]"
                           value="<?php echo(!empty($options['OfficeID']) ? $options['OfficeID'] : $account_options->OfficeID); ?>"/><br/>
                    <span class="description">This is the Office ID as assigned to your office by the MLS you are using to provide data to this site.</span>
                    <input type="hidden" id="dsidxpress-API-OfficeID" maxlength="35"
                           name="<?php echo DSIDXPRESS_API_OPTIONS_NAME; ?>[OfficeID]"
                           value="<?php echo(!empty($options['OfficeID']) ? $options['OfficeID'] : $account_options->OfficeID); ?>"/><br/>
                </td>
            </tr>
        </table>
        <?php if ((!defined('ZPRESS_API') || ZPRESS_API == '') && isset($account_options->EnableMemcacheInDsIdxPress) && strtolower($account_options->EnableMemcacheInDsIdxPress) == "true") { ?>
            <h2>Memcache Options</h2>
            <?php if (!class_exists('Memcache') && !class_exists('Memcached')) { ?>
                <span class="description">Warning PHP is not configured with a Memcache module. See <a
                            href="http://www.php.net/manual/en/book.memcache.php" target="_blank">here</a> or <a
                            href="http://www.php.net/manual/en/book.memcached.php" target="_blank">here</a> to implement one.</span>
            <?php } ?>
            <table class="form-table">
                <tr>
                    <th>
                        <label for="dsidxpress-MemcacheHost">Host:</label>
                    </th>
                    <td>
                        <input type="text" id="dsidxpress-MemcacheHost" maxlength="49"
                               name="<?php echo DSIDXPRESS_OPTION_NAME; ?>[MemcacheHost]"
                               value="<?php echo @$options["MemcacheHost"]; ?>"/><br/>
                        <span class="description"></span>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="dsidxpress-MemcachePort">Port:</label>
                    </th>
                    <td>
                        <input type="text" id="dsidxpress-MemcachePort" maxlength="49"
                               name="<?php echo DSIDXPRESS_OPTION_NAME; ?>[MemcachePort]"
                               value="<?php echo @$options["MemcachePort"]; ?>"/><br/>
                        <span class="description"></span>
                    </td>
                </tr>
            </table>
        <?php } ?>
        <p class="submit">
            <input type="submit" class="button-primary" name="Submit" value="Save Options"/>
        </p>
    </form>
</div>