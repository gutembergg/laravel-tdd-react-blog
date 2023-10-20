import { ReactNode } from 'react';

interface ShowRootProps {
    children: ReactNode;
}

function ShowRoot({ children }: ShowRootProps) {
    return (
        <div
            className="h-screen flex flex-col items-center justify-center py-12 
                space-y-10 max-w-[900px]"
        >
            {children}
        </div>
    );
}

export default ShowRoot;
