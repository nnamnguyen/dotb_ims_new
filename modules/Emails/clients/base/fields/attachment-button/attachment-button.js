
/**
 * Attachment button is a label that is styled like a button and will trigger a
 * given file input field.
 *
 * @class View.Fields.Base.Emails.AttachmentButtonField
 * @alias DOTB.App.view.fields.BaseEmailsAttachmentButtonField
 * @extends View.Fields.Base.ButtonField
 * @deprecated Use {@link View.Fields.Base.Emails.EmailAttachmentsField}
 * instead.
 */
({
    extendsFrom: 'ButtonField',

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        app.logger.warn('View.Fields.Base.Emails.AttachmentButtonField is deprecated. Use ' +
            'View.Fields.Base.Emails.EmailAttachmentsField instead.');

        this._super('initialize',[options]);
        this.fileInputId = this.context.get('attachment_field_email_attachment');
    }
})
