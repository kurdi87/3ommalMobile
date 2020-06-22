update admission set create_user= (select action_emp from admissionprocess where admission_id=admission.id and action_id=1 limit 1);

update invoice set create_user= (select action_emp from invoiceprocess where invoice_id=invoice.id and action_id=1 limit 1);

update claim set create_user= (select action_emp from claimprocess where claim_id=claim.id and action_id=1 limit 1);

update gop set create_user= (select action_emp from gopprocess where gop_id=gop.id and action_id=1 limit 1);

update appointment set create_user= (select action_emp from appointmentprocess where appointment_id=appointment.id and action_id=1 limit 1);

update request_to_call set create_user= (select action_emp from request_to_callprocess where request_to_call_id=request_to_call.id and action_id=1 limit 1);

update commitment set create_user= (select action_emp from commitmentprocess where commitment_id=commitment.id and action_id=1 limit 1);

update lead set create_user= (select action_emp from leadprocess where lead_id=lead.id and action_id=1 limit 1);
