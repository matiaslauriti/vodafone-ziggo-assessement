export interface Auth {
    user: User;
}

export type AppPageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
};

export interface User {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
}

export type Scan = {
    id: number;
    status: 'pending' | 'in-progress' | 'completed' | 'failed';
    started_at: string;
    finished_at: string;
    customers: Array<{
        id: number;
        external_customer_id: number;
        fraudulent: boolean;
        error_message?: string;
        bsn: number;
        iban: string;
        first_name: string;
        last_name: string;
        date_of_birth: string;
        phone_number: string;
        street: string;
        postal_code: string;
        city: string;
        products: string[];
        tag: string;
        ip_address: string;
        last_invoice_at: string;
        last_login_at: string;
    }>;
};
