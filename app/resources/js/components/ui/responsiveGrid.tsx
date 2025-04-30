import { ReactNode } from 'react';
import { motion } from 'framer-motion';

interface ResponsiveGridProps {
  children: ReactNode;
  className?: string; // para permitir personalización opcional
}

export default function ResponsiveGrid({ children, className = '' }: Readonly<ResponsiveGridProps>) {
  return (
    <div className='flex justify-center mx-auto'>
      <motion.div
        className={`grid gap-4 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 ${className}`}
        initial="hidden"
        animate="visible"
        variants={{
          hidden: { opacity: 0, y: 10 },
          visible: {
            opacity: 1,
            y: 0,
            transition: { staggerChildren: 0.1 },
          },
        }}
      >
        {children}
        </motion.div>
    </div>
  );
}
