import { SidebarProvider, SidebarTrigger } from "@/components/ui/sidebar";
import { AppSidebarOwner } from "@/components/sidebar/app-sidebar-owner";
import { AppSidebarGuest } from "@/components/sidebar/app-sidebar-guest";
import { useAppSelector } from "@/store/hooks"
import type { UserRoles } from '@/types/roles'

interface Props {
    children: React.ReactNode;
}

export default function Layout({ children }: Props) {
    
    const user = useAppSelector(state => state.auth.user);
    const role = (user?.role as UserRoles) || "guest";

    let sidebarByRole: React.ReactNode;
    if (role === 'guest') {
        sidebarByRole = <AppSidebarOwner />;
    } else if (role === 'owner') { 
        sidebarByRole = <AppSidebarGuest />;
    }

    return (
        <SidebarProvider>
            {sidebarByRole}
            <SidebarTrigger/>
            {children}
        </SidebarProvider>
    )
}  