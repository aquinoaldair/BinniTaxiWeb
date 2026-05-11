export interface NavigationItem {
    label: string;
    href: string;
    active: boolean;
    visible: boolean;
}

export interface PageProps {
    title?: string;
    auth: {
        user: {
            id: number;
            name: string;
            email: string;
        } | null;
    };
    flash: {
        status: string | null;
    };
    errors: Record<string, string[]>;
    navigation: NavigationItem[];
    logoutUrl: string | null;
}
