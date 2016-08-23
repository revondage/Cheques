/*
 * File: app/view/submenuconfigCheques.js
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

Ext.define('Cheques.view.submenuconfigCheques', {
    extend: 'Ext.window.Window',
    alias: 'widget.submenuconfigCheques',

    requires: [
        'Cheques.view.submenuimprimirChequesViewModel2',
        'Cheques.view.submenuimprimirChequesViewController2',
        'Ext.form.Panel',
        'Ext.form.field.ComboBox',
        'Ext.button.Button',
        'Ext.toolbar.Spacer'
    ],

    controller: 'submenuconfigcheques',
    viewModel: {
        type: 'submenuconfigcheques'
    },
    modal: true,
    draggable: false,
    height: 231,
    id: 'submenuconfigCheques',
    resizable: false,
    width: 489,
    title: 'Imprimir Cheques',

    items: [
        {
            xtype: 'form',
            height: 182,
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
                            xtype: 'combobox',
                            id: 'cmbBanco',
                            fieldLabel: 'Banco',
                            name: 'cmbBanco'
                        },
                        {
                            xtype: 'combobox',
                            id: 'cmbCheque',
                            fieldLabel: 'Version Cheque',
                            name: 'cmbCheque'
                        },
                        {
                            xtype: 'combobox',
                            id: 'cmbImpresora',
                            fieldLabel: 'Impresora',
                            name: 'cmbImpresora'
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
                            text: 'ACEPTAR',
                            listeners: {
                                click: 'onButtonClick'
                            }
                        },
                        {
                            xtype: 'tbspacer',
                            width: 20
                        }
                    ]
                }
            ]
        },
        {
            xtype: 'panel',
            hidden: true,
            id: 'panelCheque1'
        }
    ]

});