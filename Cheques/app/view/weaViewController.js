/*
 * File: app/view/weaViewController.js
 *
 * This file was generated by Sencha Architect version 3.5.1.
 * http://www.sencha.com/products/architect/
 *
 * This file requires use of the Ext JS 6.0.x library, under independent license.
 * License of Sencha Architect does not include license for Ext JS 6.0.x. For more
 * details see http://www.sencha.com/license or contact license@sencha.com.
 *
 * This file will be auto-generated each and everytime you save your project.
 *
 * Do NOT hand edit this file.
 */

Ext.define('Cheques.view.weaViewController', {
    extend: 'Ext.app.ViewController',
    alias: 'controller.wea',

    onWindowAfterRender: function(component, eOpts) {
        // console.log(Ext._txtNombre);
        Ext.getCmp('nombreRecibe').setHidden(false);
        var valor = Ext.getCmp('nombreRecibe').setValue(Ext._txtNombre);
        valor = Ext.getCmp('nombreRecibe').setStyle({'font-family':'Anonymous Pro','font-size':'6','font-weight': '500'});
        valor.setPosition(50,100, false);

        Ext.getCmp('cantidadRecibe').setHidden(false);
        var valor = Ext.getCmp('cantidadRecibe').setValue(Ext._txtCantidad);
        valor = Ext.getCmp('cantidadRecibe').setStyle({'font-family':'Anonymous Pro','font-size':'6','font-weight': '500'});
        valor.setPosition(500,100, false);

        Ext.getCmp('fechaRecibe').setHidden(false);
        var valor = Ext.getCmp('fechaRecibe').setValue(Ext._dtFecha);
        valor = Ext.getCmp('fechaRecibe').setStyle({'font-family':'Anonymous Pro','font-size':'6','font-weight': '500'});
        valor.setPosition(415,50, false);

        Ext.getCmp('leyendaRecibe').setHidden(false);
        var valor = Ext.getCmp('leyendaRecibe').setValue(Ext._cmbLeyenda);
        valor = Ext.getCmp('leyendaRecibe').setStyle({'font-family':'Anonymous Pro','font-size':'6','font-weight': '900'});
        valor.setPosition(150,73, false);

    }

});
