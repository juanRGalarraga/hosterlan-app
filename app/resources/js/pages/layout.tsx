import { ReactNode } from "react"
import { increment } from "@/store/slices/counterSlice";
import { useAppDispatch } from "@/store/hooks";
interface Props { 
    children: ReactNode;
}

export default function Layout({ children }: Props) {
    const dispatch = useAppDispatch()

    return (
        <div>
            <header>
                <h2>Mi App</h2>
            </header>
            <main>{children}</main>

            <button type="button" onClick={() => dispatch(increment())}>Increment</button>
        </div>
    )
}  