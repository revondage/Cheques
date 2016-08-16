/*
 * File: app/view/submenuimprimirCheques.js
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

Ext.define('Cheques.view.submenuimprimirCheques', {
    extend: 'Ext.window.Window',
    alias: 'widget.submenuimprimirCheques',

    requires: [
        'Cheques.view.submenuimprimirChequesViewModel',
        'Cheques.view.submenuimprimirChequesViewController',
        'Ext.form.Panel',
        'Ext.form.field.Date',
        'Ext.form.field.ComboBox',
        'Ext.button.Button',
        'Ext.toolbar.Spacer'
    ],

    controller: 'submenuimprimircheques',
    viewModel: {
        type: 'submenuimprimircheques'
    },
    modal: true,
    draggable: false,
    height: 278,
    resizable: false,
    width: 489,
    title: 'Imprimir Cheques',

    items: [
        {
            xtype: 'form',
            height: 228,
            bodyPadding: 10,
            items: [
                {
                    xtype: 'container',
                    flex: 1,
                    layout: {
                        type: 'vbox',
                        align: 'stretch'
                    },
                    items: [
                        {
                            xtype: 'textfield',
                            id: 'txtNombre',
                            fieldLabel: 'Nombre',
                            name: 'txtNombre'
                        },
                        {
                            xtype: 'textfield',
                            id: 'txtCantidad',
                            fieldLabel: 'Cantidad',
                            name: 'txtCantidad'
                        },
                        {
                            xtype: 'datefield',
                            id: 'dtFecha',
                            fieldLabel: 'Fecha',
                            name: 'dtFecha',
                            format: '%A %B Y'
                        },
                        {
                            xtype: 'combobox',
                            id: 'cmbLeyenda',
                            fieldLabel: 'Leyenda',
                            name: 'cmbLeyenda',
                            displayField: 'leyenda',
                            store: 'cmbLeyenda',
                            valueField: 'leyenda'
                        }
                    ]
                },
                {
                    xtype: 'container',
                    layout: {
                        type: 'hbox',
                        align: 'middle',
                        pack: 'center'
                    },
                    items: [
                        {
                            xtype: 'button',
                            text: 'Imprimir',
                            listeners: {
                                click: 'onButtonClick'
                            }
                        },
                        {
                            xtype: 'tbspacer',
                            width: 20
                        },
                        {
                            xtype: 'button',
                            text: 'Configurar',
                            listeners: {
                                click: 'onButtonClick1'
                            }
                        }
                    ]
                }
            ]
        },
        {
            xtype: 'panel',
            hidden: true,
            id: 'panelCheque'
        }
    ]

});