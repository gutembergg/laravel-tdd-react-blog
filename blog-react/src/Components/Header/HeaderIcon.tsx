import { ElementType } from 'react';

interface HeaderIconProps {
    icon: ElementType;
}

function HeaderIcon({ icon: Icon }: HeaderIconProps) {
    return <Icon size={35} />;
}

export default HeaderIcon;
