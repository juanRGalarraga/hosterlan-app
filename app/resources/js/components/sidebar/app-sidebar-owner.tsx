import {
    Sidebar,
    SidebarContent,
    SidebarGroup,
    SidebarGroupContent,
    SidebarGroupLabel,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from "@/components/ui/sidebar"
import { Calendar, Home, Inbox, Search, Settings, CirclePlus } from "lucide-react"


export const ITEMS = [
    {
      title: "Inicio",
      url: route('v2'),
      icon: Home,
    },
    {
      title: "Publicaciones",
      url: route('publications.list'),
      icon: Inbox,
      childs: [
        {
          title: "Crear publicación",
          url: "#",
          icon: CirclePlus
        }
      ]
    },
    {
      title: "Mis propiedades",
      url: "#",
      icon: Calendar,
    },
    {
      title: "Reservas confirmadas",
      url: "#",
      icon: Search,
    },
    {
      title: "Settings",
      url: "#",
      icon: Settings,
    },
  ]



  export function AppSidebarOwner() {
    return (
        <Sidebar>
            <SidebarContent>
                <SidebarGroup>
                    <SidebarGroupLabel>Menu</SidebarGroupLabel>
                    <SidebarGroupContent>
                    <SidebarMenu>
                        {ITEMS.map((item) => (
                          <SidebarMenuItem key={item.title}>
                              <SidebarMenuButton asChild>
                              <a href={item.url}>
                                  <item.icon />
                                  <span>{item.title}</span>
                              </a>
                            </SidebarMenuButton>
                            {item.childs?.map((child) => (
                                <SidebarMenuItem className="ml-2" key={child.title}>
                                    <SidebarMenuButton asChild>
                                        <a href={child.url}>
                                            <child.icon />
                                            <span>{child.title}</span>
                                        </a>
                                    </SidebarMenuButton>
                                </SidebarMenuItem>
                            ))}
                          </SidebarMenuItem>
                        ))}
                    </SidebarMenu>
                    </SidebarGroupContent>
                </SidebarGroup>
            </SidebarContent>
        </Sidebar>
    )
}