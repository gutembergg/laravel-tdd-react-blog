import { ReactNode } from 'react';

interface ShowRootProps {
    children: ReactNode;
}

function ShowRoot({ children }: ShowRootProps) {
    return <div>{children}</div>;
}

export default ShowRoot;
