import React from "react"
import { Link } from "@inertiajs/inertia-react"

export default function Paginate({ links }) {
  return (
    <nav className="flex gap-4">
      {links.map(
        (link, idx) =>
          link.url && (
            <Link
              key={idx}
              href={link.url}
              className={
                link.active
                  ? "rounded text-white py-2 px-4 bg-violet-900"
                  : "rounded text-white p-2 bg-violet-600"
              }
              preserveScroll
            >
              {link.label}
            </Link>
          )
      )}
    </nav>
  )
}
