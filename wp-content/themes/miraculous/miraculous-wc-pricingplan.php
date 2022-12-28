<?php
/***
 * Template Name:pricingplan wc
 * 
 * Miraculous Blog Template
 * @package Miraculous
 */
get_header();
?>
<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <div class="ms_main_wrapper ms_blog_temp">
			<div class="container">
			   <div class="row">
			       
                <h2 style="text-align:center">Responsive Pricing Tables</h2>
                <p style="text-align:center">Resize the browser window to see the effect.</p>
                
                <div class="columns">
                  <ul class="price">
                    <li class="header">Basic</li>
                    <li class="grey">$ 9.99 / year</li>
                    <li>10GB Storage</li>
                    <li>10 Emails</li>
                    <li>10 Domains</li>
                    <li>1GB Bandwidth</li>
                    <li class="grey"><a href="javascript:void(0);" class="button wc_pricing_plan"  data-planprice="9.99" data-planname="Basic">Sign Up</a></li>
                  </ul>
                </div>
                
                <div class="columns">
                  <ul class="price">
                    <li class="header" style="background-color:#4CAF50">Pro</li>
                    <li class="grey">$ 24.99 / year</li>
                    <li>25GB Storage</li>
                    <li>25 Emails</li>
                    <li>25 Domains</li>
                    <li>2GB Bandwidth</li>
                    <li class="grey"><a href="javascript:void(0);" class="button wc_pricing_plan" data-planprice="24.99" data-planname="Pro">Sign Up</a></li>
                  </ul>
                </div>
                
                <div class="columns">
                  <ul class="price">
                    <li class="header">Premium</li>
                    <li class="grey">$ 49.99 / year</li>
                    <li>50GB Storage</li>
                    <li>50 Emails</li>
                    <li>50 Domains</li>
                    <li>5GB Bandwidth</li>
                    <li class="grey"><a href="javascript:void(0);" class="button wc_pricing_plan" data-planprice="49.99" data-planname="Premium">Sign Up</a></li>
                  </ul>
                </div>
                
            </div>
        </div>
    </div>
 </main>
</div>
<?php
get_footer();