import { ReactNode } from "react"

interface Props { 
    children: ReactNode;
}

export default function Layout({ children } : Props ) {
    return (
        <div>
            <header>
                <h2>Mi App</h2>
            </header>
            <main>{children}</main>
        </div>
    )
}  