<?php

declare(strict_types=1);

return [

    'label' => [
        'singular' => 'utilizator',
        'plural' => 'Utilizatori',
    ],

    'specialist_label' => [
        'singular' => 'specialist',
        'plural' => 'Specialiști',
    ],

    'labels' => [
        'first_name' => 'Nume',
        'last_name' => 'Prenume',
        'roles' => 'Roluri',
        'account_status' => 'Cont',
        'last_login_at' => 'Ultima accesare',
        'email' => 'Email',
        'phone_number' => 'Număr telefon',
        'select_roles' => 'Rol specialitate',
        'case_permissions' => 'Permisiuni cazuri',
        'admin_permissions' => 'Permisiuni administrare',
        'last_login_at_date_time' => 'Data și ora ultimei accesări',
    ],

    'stats' => [
        'open' => 'Cazuri deschise',
        'monitoring' => 'Cazuri în monitorizare',
        'closed' => 'Cazuri închise',
    ],

    'role' => [
        'admin' => 'Administrator',
        'specialist' => 'Specialist',
        'manager' => 'Manager',

    ],

    'heading' => [
        'table' => 'Echipa interdisciplinară',
        'specialist_details' => 'Detalii specialist',
    ],

    'placeholders' => [
        'obs' => 'Acest tip de utilizator <span class="italic">are acces doar la cazurile din echipa cărora face parte</span> și nu deține drepturi de administrare ale sistemului. Puteți oferi permisiuni suplimentare din lista de mai jos.',
    ],

    'actions' => [
        'deactivate' => 'Deactivează cont',
        'reset_password' => 'Resetează parola',
        'resend_invitation' => 'Retrimite invitația',
        'activate' => 'Reactivează cont',
    ],

    'action_resend_invitation_confirm' => [
        'title' => 'Retrimite invitația',
        'success' => 'Invitația a fost trimisata cu succes.',
        'failure_title' => 'Eroare la retrimiterea invitației!',
        'failure_body' => 'A aparut o eroare la retrimiterea invitației',
    ],

    'action_deactivate_confirm' => [
        'title' => 'Deactivează cont',
        'success' => 'Cont dezactivat cu succes',
        'description' => 'Odată dezactivat contul, utilizatorul nu va mai avea acces în platformă. Toate datele asociate contului vor rămâne în baza de date. Pentru a oferi din nou acces utilizatorului, va trebui să reactivați contul din profilul acestuia.'
    ],

    'status' => [
        'active' => 'Activ',
        'inactive' => 'Inactiv',
    ],
];
