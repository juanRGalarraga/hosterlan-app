import { Head } from '@inertiajs/react'
import Layout from '@/pages/layout';
import { useState } from 'react'
import Dropdown from '@/components/dropdown';
import Counter from '@/store/slices/counterSlice';

interface Props { 
  appName: string;
}

export default function Wellcome({ appName }: Props) {
  
  const [name, setName] = useState(appName)

  function handleChange(event: React.ChangeEvent<HTMLInputElement>) { 
    setName(event.target.value)
  }

  return (
    <Layout>
      <Head title="Wellcome" />
      <h1>Bienvenido a {name}</h1>
      <h2>Inertia + React + TypeScript</h2>
      <input type="text" value={name} onChange={handleChange} />


      <Dropdown
        trigger={<button className="px-4 py-2 bg-blue-500 text-white rounded">Abrir</button>}
        content={<ul className="p-2"><li>Item 1</li><li>Item 2</li></ul>}
      />

      <Counter/>
            
    </Layout>
  )
}