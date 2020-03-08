#!/usr/bin/env bash

read -r -d '' USAGE <<EOS
Usage: $(basename $0) [OPTIONS]

OPTIONS:
  -h, --help                Show usage information.
  -v, --verbose             Output verbose script info.
  -f, --apply-from <FILE>   Apply files listed in <FILE>.
  -t, --tag <TAG>           The name of the tagged release (e.g. v1.2.49).
EOS

CP="$(\which cp)"
CURL="$(\which curl)"
GIT="$(\which git)"
MKDIR="$(\which mkdir)"
RM="$(\which rm)"
TAR="$(\which tar)"

while [[ $# -gt 0 ]]; do
	case $1 in
		-h|--help)
			printf '%s\n' "$USAGE"
			exit 0
		;;
		-v|--verbose)
			shift
			set -v
		;;
		-f|--apply-from)
			shift
			FILE="$(realpath $1)"
			shift
		;;
		-t|--tag)
			shift
			TAG="$1"
			shift
		;;
		*)
			shift
		;;
	esac
done

if [[ -z "$TAG" ]]; then
	printf '%s\n' "$USAGE"
	exit 1
fi

ARCHIVE="${TAG}.tar.gz"
TAGURL="https://github.com/magento/magento2/archive/${ARCHIVE}"
TAGDIR="magento2-${TAG}"
REPODIR="$($GIT rev-parse --show-toplevel)"

$CURL -fsSLO \
      --progress-bar \
      $TAGURL

if [[ ! -f "$ARCHIVE" ]]; then
	printf 'Unable to locate archive %s. Exiting...\n' "$ARCHIVE"
	exit 1
fi

$TAR -xzf "${ARCHIVE}"

if [[ ! -d "$TAGDIR" ]]; then
	printf 'Unable to locate directory %s. Exiting...\n' "$TAGDIR"
	exit 1
fi

while read -u 3 LINE; do
	SRCRELPATH="${TAGDIR}/${LINE}"
	SRCABSPATH="$(realpath ${SRCRELPATH})"

	DSTABSPATH="${REPODIR}/${LINE}"
	DSTDIRNAME="$(dirname ${DSTABSPATH})"

	if [[ ! -d "${DSTDIRNAME}" ]]; then
		$MKDIR -p "${DSTDIRNAME}"
	fi

	$CP -fp "${SRCABSPATH}" "${DSTABSPATH}"
done 3< $FILE

$RM -rf "$ARCHIVE" "$TAGDIR"
