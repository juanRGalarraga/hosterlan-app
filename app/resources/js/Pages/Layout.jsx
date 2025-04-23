export default function Layout({ children }) {
    return (
        <div>
        <header>
            <h2>Mi App</h2>
        </header>
        <main>{children}</main>
        </div>
    )
}  