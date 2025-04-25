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
      id: 0,
      title: "Inicio",
      url: route('v2'),
      icon: Home,
    },
  {
      id: 1,
      title: "Publicaciones",
      url: route('publications.index'),
      icon: Inbox,
      childs: [
        {
          id: '01',
          title: "Crear publicación",
          url: "#",
          icon: CirclePlus
        }
      ]
    },
  {
      id: 2,
      title: "Mis propiedades",
      url: "#",
      icon: Calendar,
    },
  {
      id: 3,
      title: "Reservas confirmadas",
      url: "#",
      icon: Search,
    },
  {
      id: 4,
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
                               <SidebarMenu key={child.title}>
                                  <SidebarMenuItem className="ml-2">
                                      <SidebarMenuButton asChild>
                                          <a href={child.url}>
                                              <child.icon />
                                              <span>{child.title}</span>
                                          </a>
                                      </SidebarMenuButton>
                                  </SidebarMenuItem>
                                </SidebarMenu>
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