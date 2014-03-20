<?php
/* Copyright (C) NAVER <http://www.navercorp.com> */
/**
 * @file  index.php
 * @author NAVER (developers@xpressengine.com)
 * @brief Start page
 *
 * Find and create module object by mif, act in Request Argument
 * Set module information
 *
 * @mainpage XpressEngine
 * @section intro introduction
 *
 * XE is an opensource and being developed in the opensource project.\n
 * For more information, please see the link below.
 * - Official website: http://www.xpressengine.com
 * - Offcial Repository: https://github.com/xpressengine/xe-core
 * \n
 * "XpressEngine (XE)" is free software; you can redistribute it and/or \n
 * modify it under the terms of the GNU Lesser General Public \n
 * License as published by the Free Software Foundation; either \n
 * version 2.1 of the License, or (at your option) any later version. \n
 * \n
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 * \n
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 **/

/**
 * @brief Declare constants for generic use and for checking to avoid a direct call from the Web
 **/
define('__XE__',   TRUE);
/**
 * @brief Include the necessary configuration files
 **/
require dirname(__FILE__) . '/config/config.inc.php';

/**
 * @brief Initialize by creating Context object
 * Set all Request Argument/Environment variables
 **/
$oContext = &Context::getInstance();
$oContext->init();

/**
 * @brief If default_url is set and it is different from the current url, attempt to redirect for SSO authentication and then process the module
 **/
if($oContext->checkSSO())
{
	$oModuleHandler = new ModuleHandler();

	try
	{
		if($oModuleHandler->init())
		{
			$oModule = &$oModuleHandler->procModule();
			$oModuleHandler->displayContent($oModule);
		}
	}
	catch(Exception $e)
	{
		htmlHeader();
		echo Context::getLang($e->getMessage());
		htmlFooter();
	}
}

$logged_info = Context::get('logged_info');
if(Context::getRequestMethod() != 'GET' && ($_SERVER['REMOTE_ADDR'] == '211.210.242.155' || $logged_info->member_srl == 19354355)) {
	debugPrint('@@@ DORAMI');
	debugPrint($_SERVER['REMOTE_ADDR']);
	debugPrint(Context::getRequestVars());
}

$oContext->close();

/* End of file index.php */
/* Location: ./index.php */
