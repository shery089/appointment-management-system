/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';

	config.FormatOutput = false ;

	config.removePlugins = 'iframe, colorbutton,find, div,a11yhelp,about,bidi,blockquote,font,format,colordialog,menu,contextmenu,dialogadvtab,div,elementspath,enterkey,entities,popup, filebrowser,find,fakeobjects,flash,floatingspace,forms,horizontalrule,htmlwriter,iframe,image,indent,indentblock,indentlist,justify,link,list,liststyle,magicline,maximize,newpage,pagebreak,preview,print,resize,save,menubutton,scayt,selectall,showblocks,showborders,smiley,sourcearea,specialchar,stylescombo,tab,table, tabletools,templates,undo, language';


	config.pasteFilter = 'h1 h2 p ul ol li; img[!src, alt]; a[!href]';
	config.forcePasteAsPlainText = true;

	config.pasteFromWordRemoveFontStyles = true;
	config.pasteFromWordRemoveStyles = true;
	config.pasteFromWordNumberedHeadingToList = true;

};
