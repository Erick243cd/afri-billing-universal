<?php

class Configurations extends CI_Controller
{
    public function rate()
    {
        if (!isLoggedIn()) redirect('pages/connexion');

        if (userSessData()->role_utilisateur === 'admin') {

            $data = array(
                'rate' => $this->db->get('lq_rates')->row(),
                'title' => "Fixation du taux"
            );

            $this->load->view('dashboards/header');
            $this->load->view('configurations/rate', $data);
            $this->load->view('dashboards/footer');

        } else {
            show_error("<b>Error</b>  Vous n'avez pas l'autorisation d'effectuer cette opération");
        }
    }

    public function updateRate()
    {
        $data = array(
            'rate_value' => $this->input->post('rateValue')
        );
        $this->db->update('lq_rates', $data);
        $this->session->set_flashdata('success', 'Modifications effectuées avec succès');
        redirect('configurations/rate');
    }

    public function companyInfos()
    {
        if (!isLoggedIn()) redirect('pages/connexion');

        if (userSessData()->role_utilisateur === 'admin') {

            $data = array(
                'company' => $this->db->get('lq_configs')->row(),
                'title' => "Informations sur l'entreprise"
            );

            $this->load->view('dashboards/header');
            $this->load->view('configurations/config', $data);
            $this->load->view('dashboards/footer');

        } else {
            show_error("<b>Error</b>  Vous n'avez pas l'autorisation d'effectuer cette opération");
        }
    }

    public function updateCompanyInfos()
    {
        $data = array(
            'company_name' => $this->input->post('company_name'),
            'company_slug' => url_title($this->input->post('company_name')),
            'company_rccm' => $this->input->post('company_rccm'),
            'company_idnat' => $this->input->post('company_idnat'),
            'company_address' => $this->input->post('company_address'),
            'company_tax_number' => $this->input->post('company_tax_number'),
            'company_email' => $this->input->post('company_email'),
            'company_phone' => $this->input->post('company_phone')
        );
        $this->db->update('lq_configs', $data);
        $this->session->set_flashdata('success', 'Modifications effectuées avec succès');
        redirect('configurations/companyInfos');
    }
}
