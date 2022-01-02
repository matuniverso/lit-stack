import React from "react"
import Authenticated from "@/Layouts/Authenticated"
import ValidationErrors from "@/Components/ValidationErrors"
import { Head, useForm } from "@inertiajs/inertia-react"
import { Inertia } from "@inertiajs/inertia"

export default function Profile({ auth }) {
  const { setData, post, errors } = useForm({
    profile_pic: ""
  })

  const onChange = (e) => {
    setData("profile_pic", e.target.files[0])
  }

  const onSubmit = (e) => {
    e.preventDefault()
    post(route("profile.update"), {
      preserveScroll: true
    })
  }

  const removePic = () => {
    Inertia.delete(route("profile.delete"), {
      preserveScroll: true
    })
  }

  return (
    <Authenticated
      auth={auth}
      header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Profile</h2>}
    >
      <Head title="Profile" />

      <div className="py-12">
        <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <ValidationErrors errors={errors} />

          {auth.user.profile_pic ? (
            <img
              alt="profile picture"
              src={`/storage/${auth.user.profile_pic}`}
              className="w-48 h-48 mb-4 object-cover"
            />
          ) : (
            <p className="mb-4 font-semibold text-3xl">No profile picture yet.</p>
          )}

          <form onSubmit={onSubmit}>
            <input type="file" onChange={onChange} />

            <div className="flex gap-3">
              <button type="submit" className="block py-2 px-4 mt-4 font-semibold bg-emerald-500">
                Update Pic
              </button>

              <button
                type="button"
                onClick={removePic}
                disabled={!auth.user.profile_pic}
                className="block py-2 px-4 mt-4 font-semibold bg-red-600 disabled:bg-gray-500 disabled:text-gray-700"
              >
                Remove Pic
              </button>
            </div>
          </form>
        </div>
      </div>
    </Authenticated>
  )
}
