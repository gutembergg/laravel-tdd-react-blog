import { ReactNode } from 'react';

interface HeaderProps {
    children: ReactNode;
}

function HeaderRoot({ children }: HeaderProps) {
    return (
        <nav className="bg-black">
            <div
                className="flex justify-between w-[90%] text-black dark:text-yellow-600 
                        mx-auto  px-2 py-4 sm:px-6 lg:px-8 
                        space-x-6"
            >
                {children}
            </div>
        </nav>
    );
}

export default HeaderRoot;
