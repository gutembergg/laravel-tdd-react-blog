import { ReactNode } from 'react';

interface ShowRootProps {
    children: ReactNode;
}

function ShowRoot({ children }: ShowRootProps) {
    return <div className="flex flex-col justify-center items-center py-12 space-y-10">{children}</div>;
}

export default ShowRoot;
